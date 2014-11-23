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
            'entity' => $category
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
        $category = new Category();
        $form   = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('backend_category_create')
        ));

        return $this->render('AppBundle:Backend\Category:new.html.twig', array(
            'entity' => $category,
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
        $category  = new Category();
        $form    = $this->createForm(new CategoryType(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->render('AppBundle:Backend/Category:show.html.twig', array(
                'entity' => $category
            ));
        }

        return $this->render('AppBundle:Backend/Category:new.html.twig', array(
            'entity' => $category,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to modify a Category entity.
     *
     * @param Category $category
     *
     * @return Response
     *
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function editAction(Category $category)
    {
        if (!$category) {
            throw $this->createNotFoundException("Error, We haven't founded this category");
        }

        $form = $this->createForm(new CategoryType(), $category,
            array(
                'action' => $this->generateUrl('backend_category_update',
                                            array(
                                                    'id' => $category->getId()
                                                )
                                            )
        ));

        return $this->render('AppBundle:Backend/Category:edit.html.twig', array(
            'entity'      => $category,
            'form'   => $form->createView()
        ));
    }

    /**
     * Modifies a Category
     *
     * @param Category $category
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function updateAction(Category $category,Request $request)
    {
        if (!$category) {
            throw $this->createNotFoundException("Error, We haven't founded this category");
        }
        $form   = $this->createForm(new CategoryType(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->render('AppBundle:Backend/Category:show.html.twig', array(
                'entity' => $category
            ));
        }

        return $this->render('AppBundle:Backend/Category:edit.html.twig', array(
            'entity'      => $category,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Removes a Category
     *
     * @param Category $category
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function deleteAction(Category $category, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$category) {
            throw $this->createNotFoundException('No se ha encontrado la categoria solicitada');
        }

        $em->remove($category);
        $em->flush();
        if ($request->isXmlHttpRequest()) {
            $return = json_encode(array("result" => "OK"));

            return new Response($return,200, array('Content-Type' => 'application/json'));
        } else {
            return $this->redirect($this->generateUrl('backend_category_index'));
        }
    }
}
