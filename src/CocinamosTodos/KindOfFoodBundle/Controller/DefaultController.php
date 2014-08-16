<?php

namespace CocinamosTodos\KindOfFoodBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KindOfFoodBundle:Default:index.html.twig', array('name' => $name));
    }
}
