<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseSlug;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="kind_of_food")
 * @ORM\Entity()
 */

class KindOfFood extends BaseSlug
{
    /**
     * @var string $name
     *
     * @ORM\Column(name="name",type="string",nullable=true)
     */
    protected $name;

    /**
     * @ORM\OneToMany (targetEntity="AppBundle\Entity\Recipe", mappedBy="kindOfFood", cascade={"all"})
     */
    protected $recipes;

    /**
     * Set name
     *
     * @param  string     $name
     * @return KindOfFood
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __construct()
    {
        parent::__construct();
        $this->recipes  = new ArrayCollection();
    }

    /**
     * Add recipe
     *
     * @param  \AppBundle\Entity\Recipe $recipe
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
