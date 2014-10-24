<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseSlug;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="nationality")
 * @ORM\Entity()
 */

class Nationality extends BaseSlug{

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
     * Set name
     *
     * @param string $name
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
