<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 26/10/14
 * Time: 10:47
 */

namespace AppBundle\Entity\Base;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Recipe;
use Doctrine\ORM\Mapping as ORM;


class BaseParentRecipe extends BaseSlug {

    /**
     * @ORM\OneToMany (targetEntity="AppBundle\Entity\Recipe", mappedBy="recipe", cascade={"all"})
     */
    protected $recipes;

    function __construct(){
        $this->recipes  = new ArrayCollection();
    }

    /**
     * Add recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     * @return Recipe
     */
    public function addRecipe(Recipe $recipe)
    {
        $this->recipes[] = $recipe;

        return $this;
    }

    /**
     * Remove recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     */
    public function removeRecipe(Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);
    }

    /**
     * Get recipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecipes()
    {
        return $this->recipes;
    }


} 