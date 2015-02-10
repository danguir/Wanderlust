<?php

namespace Site\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function indexAction()
    {
        return $this->render('PagesBundle::index.html.twig');
    }
}
