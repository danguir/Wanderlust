<?php

namespace Site\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function editerAction(News $news = null)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        
        $auteur = new Utilisateur();
        $auteur= $em->getRepository('SiteUtilisateurBundle:Utilisateur')->findOneBy(array('id' => $session->get('id')));

        if($session->get('rang') == 'Administrateur'){
        	if($news == null){
                $news = new News();
                $news->setAuteur($auteur);
                $flash = 'News créée avec succès';
          	}else{
          		$flash = 'News modifiée avec succès';
          	}  
        	$form = $this->createFormBuilder($news)
                ->add('titre', 'text', array('label' => 'Titre : '))
                ->add('contenu', 'textarea', array('label' => 'Contenu : ', 'required' => false, 'attr' => array('class' => 'ckeditor')))
                ->getForm();
                if($request->getMethod() == "POST"){
                    $form->bind($request);
                    $em->persist($news);
                    $em->flush();
                    $session->getFlashBag()->add('success', $flash);
                    return $this->redirect($this->generateUrl('news_liste'));
                }
            return $this->render('SiteNewsBundle::editer.html.twig', array(
                'form' => $form->createView(),
            ));
        }
        return $this->redirect($this->generateUrl('index')); 
    }	  

    public function listeAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$news = $em->getRepository('SiteNewsBundle:News')->findBy(array('etat' => false), array('id' => 'DESC'));
    	return $this->render('SiteNewsBundle::liste.html.twig', array(
    		'news' => $news,
		));
    }

    public function listeIndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('SiteNewsBundle:News')->findBy(array('etat' => false), array('id' => 'DESC'));
        return $this->render('SiteNewsBundle:include:liste.html.twig', array(
            'news' => $news,
        ));
    }

    public function supprimerAction(News $news)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if($session->get('rang') == 'Administrateur'){
            $em->remove($news);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('news_liste'));
    }
}
