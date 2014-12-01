<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 14:04
 */

namespace AppBundle\Entity;

interface RecipeManagerInterface {

    /**
     * @return mixed
     */
    public function createRecipe();

    /**
     * @param Recipe $recipe
     * @return mixed
     */
    public function deleteRecipe(Recipe $recipe);

    public function updateRecipe(Recipe $recipe);

    public function getClass();

    public function saveRecipe(Recipe $recipe);

    public function findRecipes();

    public function findRecipeBySlug($slug);


} 