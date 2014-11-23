<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseSlug;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CategoryRepository")
 */

class Category extends BaseSlug
{
    /**
     * @var string $name
     *
     * @ORM\Column(name="name",type="string",nullable=false)
     */
    protected $name;

    /**
     * @var integer $order
     *
     * @ORM\Column(name="cat_order",type="integer",nullable=false)
     */
    protected $order;

    /**
     * @var boolean $visible
     *
     * @ORM\Column(name="visible",type="boolean",nullable=false)
     *
     * @Assert\Type(type="bool")
     */
    protected $visible;

    /**
     * @ORM\OneToMany (targetEntity="AppBundle\Entity\Recipe", mappedBy="category", cascade={"all"})
     */
    protected $recipes;

    /**
     * @ORM\OneToMany(targetEntity="category", mappedBy="parent")
     **/
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    protected $parent;

    public function __construct()
    {
        parent::__construct();
        $this->children = new ArrayCollection();
        $this->recipes  = new ArrayCollection();
        $this->visible  = true;
        $this->order    = 0;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string   $name
     * @return Category
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

    /**
     * Set order
     *
     * @param integer
     * @return Category
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set visible
     *
     * @param boolean
     * @return Category
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * Add children
     *
     * @param  \AppBundle\Entity\category $children
     * @return Category
     */
    public function addChild(category $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \AppBundle\Entity\category $children
     */
    public function removeChild(category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param  \AppBundle\Entity\category $parent
     * @return Category
     */
    public function setParent(category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\category
     */
    public function getParent()
    {
        return $this->parent;
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
