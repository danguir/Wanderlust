<?php

namespace Site\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    public function indexAction()
    {
        return $this->render('MediaBundle:Default:index.html.twig');
    }
}
