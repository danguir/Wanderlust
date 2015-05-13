<?php

namespace Site\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
      public function photosAction(Album $album = null)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
                
        if($album){
            $countfiles = -2;
            $pointeur = \opendir('albums/'.$album->getSlug());
            while($file = \readdir($pointeur)) {
                $countfiles += 1;
            }
            \closedir($pointeur);
            $pointeur = \opendir('albums/'.$album->getSlug());
            $i = 0;
            $rand = $countfiles - \rand(1, $countfiles);
            while($fichier = \readdir($pointeur)){
                if(\substr($fichier, -3) == "gif" || \substr($fichier, -3) == "jpg" || \substr($fichier, -3) == "png" || \substr($fichier, -4) == "jpeg" || \substr($fichier, -3) == "PNG" || \substr($fichier, -3) == "GIF" || \substr($fichier, -3) == "JPG"){
                    $photos[$i] = $fichier;
                    if(intval($rand) == $i){
                        $couverture = $photos[$i];
                    }
                    $i++;
                }else{
                    $photos = null;
                }
            }
            \closedir($pointeur);
            if($photos != NULL){
                $album->setCouverture($couverture);
                $em->persist($album);
                $em->flush();
            }
            return $this->render('SiteMediaBundle::photos.html.twig', array(
                'album' => $album,
                'photos' => $photos,
            ));
        }else{
            $albums = $em->getRepository('SiteMediaBundle:Album')->findBy(array(), array('id' => 'DESC'));
            $album = new Album();
            $formAlbum = $this->createForm(new AlbumType, $album);
            $dates = $em->getRepository('SiteMediaBundle:Date')->findBy(array(), array('id' => 'DESC'));
            if($request->getMethod() == 'POST'){
                // Album
                $formAlbum->bind($request);
                $data = $request->request->get('albumtype');

                $before = array(
                    'àáâãäåòóôõöøèéêëðçìíîïùúûüñšž',
                    '/[^a-z0-9\s]/',
                    array('/\s/', '/--+/', '/---+/')
                );
                $after = array(
                    'aaaaaaooooooeeeeeciiiiuuuunsz',
                    '',
                    '-'
                );
                $chaine = preg_replace("`\[.*\]`U","",$data['nom']);
                $chaine = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$chaine);
                $chaine = htmlentities($chaine, ENT_NOQUOTES, 'UTF-8');
                $chaine = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i","\\1", $chaine );
                $chaine = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $chaine);
                $chaine = ( $chaine == "" ) ? $type : strtolower(trim($chaine, '-'));

                if(!\file_exists('albums/'.$chaine)){
                    \mkdir('albums/'.$chaine);
                }
                $album->setNom($data['nom']);
                $album->setSlug($chaine);
                $em->persist($album);
                $em->flush();
                $session->getFlashBag()->add('success', 'Album créer avec succès !');
                return $this->redirect($this->generateUrl('album_editer'));
            }
            return $this->render('SiteMediaBundle::albums.html.twig', array(
                'formAlbum' => $formAlbum->createView(),
                'albums' => $albums,
                'dates' => $dates,
            ));
        }
    }
    
    public function listeAction(Album $album)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

         if($album){
            $countfiles = -2;
            $pointeur = \opendir('albums/'.$album->getSlug());
            while($file = \readdir($pointeur)) {
                $countfiles += 1;
            }
            \closedir($pointeur);
            $pointeur = \opendir('albums/'.$album->getSlug());
            $i = 0;
            $rand = $countfiles - \rand(1, $countfiles);
            while($fichier = \readdir($pointeur)){
                if(\substr($fichier, -3) == "gif" || \substr($fichier, -3) == "jpg" || \substr($fichier, -3) == "png" || \substr($fichier, -4) == "jpeg" || \substr($fichier, -3) == "PNG" || \substr($fichier, -3) == "GIF" || \substr($fichier, -3) == "JPG"){
                    $photos[$i] = $fichier;
                    if(intval($rand) == $i){
                        $couverture = $photos[$i];
                    }
                    $i++;
                }else{
                    $photos = null;
                }
            }
            \closedir($pointeur);
            if($photos != NULL){
                $album->setCouverture($couverture);
                $em->persist($album);
                $em->flush();
            }
            return $this->render('SiteMediaBundle::liste_photos.html.twig', array(
                'album' => $album,
                'photos' => $photos,
            ));
         }else{
                return $this->redirect($this->generateUrl('index'));
         }
    }
    
    public function listeAlbumAction(Date $annee)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        
        $albums = $em->getRepository('SiteMediaBundle:Album')->findAll(array('annee' => $annee));
        
        return $this->redirect($this->generateUrl('album_editer'));
    }
    
    public function supprimerAction(Album $album)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if($session->get('rang') == 'Administrateur'){
            $em->remove($album);
            $em->flush();
            $session->getFlashBag()->add('success','photo supprimée avec succes');
        }
        
        return $this->redirect($this->generateUrl('album_editer'));
    }   
    
    public function triAlbumAction(Date $date)
    {
        $em = $this->getDoctrine()->getManager();
        $albums = $em->getRepository('SiteMediaBundle:Album')->findBy(array('annee' => $date->getId()));
        return $this->render('SiteMediaBundle:include:album_date.html.twig', array(
                'albums' => $albums,
            ));       
    } 
}
