<?php

namespace CocinamosTodos\RecipeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RecipeBundle:Default:index.html.twig', array('name' => $name));
    }
}
