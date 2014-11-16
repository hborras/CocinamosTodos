<?php

namespace AppBundle\Controller\BackendController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Category;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('::backend.html.twig');
    }

    /**
     * Show a category and its recipes
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function showAction(Category $category)
    {
        return $this->render('AppBundle:Backend/Category:show.html.twig', array(
            'category' => $category
        ));
    }
}
