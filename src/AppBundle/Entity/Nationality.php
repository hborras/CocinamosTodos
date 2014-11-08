<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseParentRecipe;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="nationality")
 * @ORM\Entity()
 */

class Nationality extends BaseParentRecipe
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
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Set name
     *
     * @param  string      $name
     * @return Nationality
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
}
