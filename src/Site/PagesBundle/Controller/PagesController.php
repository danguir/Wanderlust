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

    public function carnetDeBordAction()

    {
        return $this->render('PagesBundle::carnet_de_bord.html.twig');
    }

    public function actualitesSuiteAction()
    {
        return $this->render('PagesBundle::actualites_suite.html.twig');
    }

    public function valeurAction()
    {
        return $this->render('PagesBundle::valeur.html.twig');
    }
    
    public function checkoutDevisAction()
    {
        return $this->render('PagesBundle::checkout_devis.html.twig');
    }
    
    public function nosVoyagesAction()
    {
        return $this->render('PagesBundle::nos_voyages.html.twig');
    }
    
}
