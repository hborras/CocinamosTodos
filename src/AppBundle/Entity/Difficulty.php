<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseSlug;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="difficulty")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\DifficultyRepository")
 */

class Difficulty extends BaseSlug
{
    /**
     * @ORM\Column(name="name",type="string")
     *
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\OneToMany (targetEntity="AppBundle\Entity\Recipe", mappedBy="difficulty", cascade={"all"})
     */
    protected $recipes;

    /**
     * Set name
     *
     * @param  string     $name
     * @return Difficulty
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

    public function __toString()
    {
        return $this->name;
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
