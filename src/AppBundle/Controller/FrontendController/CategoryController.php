<?php

namespace AppBundle\Controller\FrontendController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Category;

class CategoryController extends Controller
{
    /**
     * Get all categories. If $root is enabled, It gets only root categories
     *
     * @param boolean $root
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($root = true)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Category')->findAllCategory($root);

        return $this->render('AppBundle:Category:index.html.twig', array(
            'categories' => $categories
        ));
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
        return $this->render('AppBundle:Category:show.html.twig', array(
            'category' => $category
        ));
    }
}
