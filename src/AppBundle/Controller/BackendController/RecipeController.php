<?php

namespace AppBundle\Controller\BackendController;

use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\RecipeManagerInterface;

class RecipeController extends Controller
{
    /**
     * Get all recipes.
     *
     * @return Response
     */
    public function indexAction()
    {
        $recipes = $this->getRecipeManager()->findRecipes();

        return $this->render('AppBundle:Backend/Recipe:index.html.twig', array(
            'recipes' => $recipes
        ));
    }

    /**
     * Show a recipe and its recipes
     *
     * @param Recipe $recipe
     * @param string $format
     *
     * @return Response
     *
     * @ParamConverter("recipe", class="AppBundle:Recipe")
     */
    public function showAction(Recipe $recipe, $format)
    {
        if ($format == 'json'){
            $serializer = $this->get('jms_serializer');
            return new Response($serializer->serialize($recipe, $format));
        }
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
        $recipe = $this->getRecipeManager()->createRecipe();
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
        $recipe  = $this->getRecipeManager()->createRecipe();
        $form    = $this->createForm(new RecipeType(), $recipe);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getRecipeManager()->saveRecipe($recipe);
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
        $form   = $this->createForm(new RecipeType(), $recipe);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getRecipeManager()->saveRecipe($recipe);

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
        $this->getRecipeManager()->deleteRecipe($recipe);
        if ($request->isXmlHttpRequest()) {
            $return = json_encode(array("result" => "OK"));

            return new Response($return,200, array('Content-Type' => 'application/json'));
        } else {
            return $this->redirect($this->generateUrl('backend_recipe_index'));
        }
    }

    /**
     * @return RecipeManagerInterface
     */
    protected function getRecipeManager()
    {
        return $this->container->get('app_bundle.manager.recipe');
    }
}
