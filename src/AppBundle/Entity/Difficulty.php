<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseParentRecipe;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="difficulty")
 * @ORM\Entity()
 */

class Difficulty extends BaseParentRecipe {

    /**
     * @ORM\Column(name="name",type="string")
     *
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * Set name
     *
     * @param string $name
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

}
