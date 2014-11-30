<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseSlug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="nationality")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\NationalityRepository")
 */

class Nationality extends BaseSlug implements NationalityInterface
{
    /**
     * @var string $name
     *
     * @ORM\Column(name="name",type="string",nullable=true)
     */
    protected $name;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path",type="string",nullable=true)
     */
    protected $path;

    /**
     * @ORM\OneToMany (targetEntity="AppBundle\Entity\Recipe", mappedBy="nationality", cascade={"all"})
     */
    protected $recipes;

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

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


    public function addRecipe(Recipe $recipe)
    {
        $this->recipes[] = $recipe;

        return $this;
    }


    public function removeRecipe(Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);
    }

    public function getRecipes()
    {
        return $this->recipes;
    }

    public function hasRecipe($name){
        return in_array($name, $this->getRecipeNames());
    }
}
