<?php

namespace S118\EbrahimiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('S118EbrahimiBundle:Default:index.html.twig', array('name' => $name));
    }
    public function goodbyAction($family)
    {
        return $this->render('S118EbrahimiBundle::goodby.html.twig', array('family' => $family));
    }
}
