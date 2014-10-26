<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 25/10/14
 * Time: 0:54
 */

namespace AppBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

abstract class BaseSlug extends Base {

    /**
     * @ORM\Column(name="slug",type="string")
     *
     * @Assert\NotBlank()
     */
    protected $slug;

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
} 