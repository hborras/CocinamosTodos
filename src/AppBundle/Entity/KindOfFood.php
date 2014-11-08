<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseParentRecipe;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="kind_of_food")
 * @ORM\Entity()
 */

class KindOfFood extends BaseParentRecipe
{
    /**
     * @var string $name
     *
     * @ORM\Column(name="name",type="string",nullable=true)
     */
    protected $name;

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

}
