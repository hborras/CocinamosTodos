<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseSlug;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="picture")
 * @ORM\Entity()
 */

class Picture extends BaseSlug {

    /**
     * @var string $path
     *
     * @ORM\Column(name="path",type="string",nullable=true)
     */
    protected $path;

    /**
     * @var integer $width
     *
     * @ORM\Column(name="width",type="integer",nullable=true)
     * @Assert\Type(type="integer")
     */
    protected $width;

    /**
     * @var integer $height
     *
     * @ORM\Column(name="height",type="integer",nullable=true)
     * @Assert\Type(type="integer")
     */
    protected $height;

    /**
     * @var string $alt
     *
     * @ORM/Column(name="alt",type="string",nullable=true)
     */

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $recipe;


    /**
     * Set path
     *
     * @param string $path
     * @return Picture
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Picture
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Picture
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set recipe
     *
     * @param Recipe $recipe
     * @return Picture
     */
    public function setRecipe(Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
