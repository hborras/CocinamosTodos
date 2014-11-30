<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 14:06
 */

namespace AppBundle\Entity;


interface NationalityInterface {

    /**
     * @return mixed
     */
    public function getId();
    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @param $path
     * @return mixed
     */
    public function setPath($path);

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param Recipe $recipe
     * @return mixed
     */
    public function addRecipe(Recipe $recipe);

    /**
     * @param Recipe $recipe
     * @return mixed
     */
    public function removeRecipe(Recipe $recipe);

    /**
     * @return mixed
     */
    public function getRecipes();

    /**
     * @param string $name
     * @return mixed
     */
    public function hasRecipe($name);

} 