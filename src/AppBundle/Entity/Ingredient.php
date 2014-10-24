<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 25/10/14
 * Time: 1:13
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Base\BaseSlug;

/**
 * @ORM\Table(name="ingredient")
 * @ORM\Entity()
 */

class Ingredient extends BaseSlug {

    /**
     * @var string $name
     *
     * @ORM\Column(name="name",type="string",nullable=true)
     */
    protected $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description",type="text",nullable=true)
     */
    protected $description;

    /**
     * @var string $description_link
     *
     * @ORM\Column(name="description_link",type="string",nullable=true)
     */
    protected $description_link;

} 