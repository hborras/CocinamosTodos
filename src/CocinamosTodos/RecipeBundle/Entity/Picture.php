<?php

namespace CocinamosTodos\RecipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="picture")
 * @ORM\Entity()
 */

class Picture {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

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
}
