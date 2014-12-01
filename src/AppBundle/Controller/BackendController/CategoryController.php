<?php

namespace AppBundle\Controller\BackendController;

use AppBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\CategoryManagerInterface;

class CategoryController extends Controller
{
    /**
     * Get all categories. If $root is enabled, It gets only root categories
     *
     * @param boolean $root
     * @param string $format
     *
     * @return Response
     */
    public function indexAction($root = false,$format)
    {
        $categories = $this->getCategoryManager()->findCategories($root);
        if ($format == 'json'){
            $serializer = $this->get('jms_serializer');
            return new Response($serializer->serialize($categories, $format));
        }
        return $this->render('AppBundle:Backend/Category:index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * Show a category and its recipes
     *
     * @param Category $category
     * @param string $format
     *
     * @return Response
     *
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function showAction(Category $category, $format)
    {
        if ($format == 'json'){
            $serializer = $this->get('jms_serializer');
            return new Response($serializer->serialize($category, $format));
        }
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
        $category = $this->getCategoryManager()->createCategory();
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
        $category = $this->getCategoryManager()->createCategory();
        $form    = $this->createForm(new CategoryType(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getCategoryManager()->saveCategory($category);
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
        $form   = $this->createForm(new CategoryType(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getCategoryManager()->saveCategory($category);
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
        $this->getCategoryManager()->deleteCategory($category);
        if ($request->isXmlHttpRequest()) {
            $return = json_encode(array("result" => "OK"));

            return new Response($return,200, array('Content-Type' => 'application/json'));
        } else {
            return $this->redirect($this->generateUrl('backend_category_index'));
        }
    }

    /**
     * @return CategoryManagerInterface
     */
    protected function getCategoryManager()
    {
        return $this->container->get('app_bundle.manager.category');
    }
}
