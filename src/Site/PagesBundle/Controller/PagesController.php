<?php

namespace Site\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function indexAction()
    {
        return $this->render('PagesBundle::index.html.twig');
    }          
        public function actualitesAction()
    {
        return $this->render('PagesBundle::actualites.html.twig');
    } 
        public function fichesVoyagesAction()
    {
        return $this->render('PagesBundle::fiche_voyage.html.twig');
    } 
}
