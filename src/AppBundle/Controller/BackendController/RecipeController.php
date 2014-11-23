<?php

namespace AppBundle\Controller\BackendController;

use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecipeController extends Controller
{
    /**
     * Get all recipes. If $root is enabled, It gets only root recipes
     *
     * @param boolean $root
     *
     * @return Response
     */
    public function indexAction($root = false)
    {
        $em = $this->getDoctrine()->getManager();

        $recipes = $em->getRepository('AppBundle:Recipe')->findAllRecipe();

        return $this->render('AppBundle:Backend/Recipe:index.html.twig', array(
            'recipes' => $recipes
        ));
    }

    /**
     * Show a recipe and its recipes
     *
     * @param Recipe $recipe
     *
     * @return Response
     *
     * @ParamConverter("recipe", class="AppBundle:Recipe")
     */
    public function showAction(Recipe $recipe)
    {
        return $this->render('AppBundle:Backend/Recipe:show.html.twig', array(
            'entity' => $recipe
        ));
    }

    /**
     * Displays a form to create a new Recipe entity.
     *
     * @return Response
     *
     */
    public function newAction()
    {
        $recipe = new Recipe();
        $form   = $this->createForm(new RecipeType(), $recipe, array(
            'action' => $this->generateUrl('backend_recipe_create')
        ));

        return $this->render('AppBundle:Backend\Recipe:new.html.twig', array(
            'entity' => $recipe,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Recipe entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $recipe  = new Recipe();
        $form    = $this->createForm(new RecipeType(), $recipe);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return $this->render('AppBundle:Backend/Recipe:show.html.twig', array(
                'entity' => $recipe
            ));
        }

        return $this->render('AppBundle:Backend/Recipe:new.html.twig', array(
            'entity' => $recipe,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to modify a Recipe entity.
     *
     * @param Recipe $recipe
     *
     * @return Response
     *
     * @ParamConverter("recipe", class="AppBundle:Recipe")
     */
    public function editAction(Recipe $recipe)
    {
        if (!$recipe) {
            throw $this->createNotFoundException("Error, We haven't founded this recipe");
        }

        $form = $this->createForm(new RecipeType(), $recipe,
            array(
                'action' => $this->generateUrl('backend_recipe_update',
                                            array(
                                                    'id' => $recipe->getId()
                                                )
                                            )
        ));

        return $this->render('AppBundle:Backend/Recipe:edit.html.twig', array(
            'entity'      => $recipe,
            'form'   => $form->createView()
        ));
    }

    /**
     * Modifies a Recipe
     *
     * @param Recipe $recipe
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("recipe", class="AppBundle:Recipe")
     */
    public function updateAction(Recipe $recipe,Request $request)
    {
        if (!$recipe) {
            throw $this->createNotFoundException("Error, We haven't founded this recipe");
        }
        $form   = $this->createForm(new RecipeType(), $recipe);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return $this->render('AppBundle:Backend/Recipe:show.html.twig', array(
                'entity' => $recipe
            ));
        }

        return $this->render('AppBundle:Backend/Recipe:edit.html.twig', array(
            'entity'      => $recipe,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Removes a Recipe
     *
     * @param Recipe $recipe
     * @param Request  $request
     *
     * @return Response
     *
     * @ParamConverter("recipe", class="AppBundle:Recipe")
     */
    public function deleteAction(Recipe $recipe, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$recipe) {
            throw $this->createNotFoundException('No se ha encontrado la categoria solicitada');
        }

        $em->remove($recipe);
        $em->flush();
        if ($request->isXmlHttpRequest()) {
            $return = json_encode(array("result" => "OK"));

            return new Response($return,200, array('Content-Type' => 'application/json'));
        } else {
            return $this->redirect($this->generateUrl('backend_recipe_index'));
        }
    }
}
