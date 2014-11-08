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

class Ingredient extends BaseSlug
{
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

    /**
     * @var string $path
     *
     * @ORM\Column(name="path",type="string",nullable=true)
     */
    protected $path;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescriptionLink()
    {
        return $this->description_link;
    }

    /**
     * @param string $description_link
     */
    public function setDescriptionLink($description_link)
    {
        $this->description_link = $description_link;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

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

}
