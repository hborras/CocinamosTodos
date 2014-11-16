<?php

namespace AppBundle\Controller\BackendController;

use AppBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Get all categories. If $root is enabled, It gets only root categories
     *
     * @param boolean $root
     *
     * @return Response
     */
    public function indexAction($root = false)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Category')->findAllCategory($root);

        return $this->render('AppBundle:Backend/Category:index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * Show a category and its recipes
     *
     * @param Category $category
     *
     * @return Response
     *
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function showAction(Category $category)
    {
        return $this->render('AppBundle:Backend/Category:show.html.twig', array(
            'category' => $category
        ));
    }

    /**
     * Displays a form to create a new Category entity.
     *
     * @return Response
     *
     */
    public function newAction()
    {
        $entity = new Category();
        $form   = $this->createForm(new CategoryType(), $entity, array(
            'action' => $this->generateUrl('backend_category_create')
        ));

        return $this->render('AppBundle:Backend\Category:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Category entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $entity  = new Category();
        $form    = $this->createForm(new CategoryType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->render('AppBundle:Backend/Category:show.html.twig', array(
                'category' => $entity
            ));
        }

        return $this->render('AppBundle:Backend/Category:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }
}
