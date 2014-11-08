<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 26/10/14
 * Time: 14:32
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Base;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_followers")
 * @ORM\Entity()
 */

class UserFollower extends Base
{
    /**
     * @var integer $user
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\User")
     */
    protected $user;

    /**
     * @var integer $recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="follower_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\User")
     */
    protected $follower;

    /**
     * Set user
     *
     * @param  User         $user
     * @return UserFavorite
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set follower
     *
     * @param  User         $follower
     * @return UserFavorite
     */
    public function setFollower(User $follower = null)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get follower
     *
     * @return User
     */
    public function getFollower()
    {
        return $this->follower;
    }
}
