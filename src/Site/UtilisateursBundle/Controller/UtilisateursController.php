<?php

namespace Site\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateursController extends Controller
{
    public function connexionAction()
    {
        
        return $this->render('UtilisateursBundle::connexion.html.twig');
    }
}
