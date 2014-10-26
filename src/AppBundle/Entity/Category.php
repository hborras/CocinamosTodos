<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseParentRecipe;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="category")
 * @ORM\Entity()
 */

class Category extends BaseParentRecipe {

    /**
     * @var string $name
     *
     * @ORM\Column(name="name",type="string",nullable=true)
     */
    protected $name;

    /**
     * @var integer $order
     *
     * @ORM\Column(name="order",type="integer",nullable=false)
     */
    protected $order;

    /**
     * @ORM\OneToMany(targetEntity="category", mappedBy="parent")
     **/
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    private $parent;

    public function __construct() {
        parent::__construct();
        $this->children = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
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
     * Add children
     *
     * @param \AppBundle\Entity\category $children
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
     * @param \AppBundle\Entity\category $parent
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
}
