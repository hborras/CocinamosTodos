<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseParentRecipe;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as Unique;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AppBundle\Entity\User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @Unique\UniqueEntity(fields="email", message="Ese correo electrónico ya está en uso. Selecciona otro", groups={"register"})
 * @Unique\UniqueEntity(fields="username", message="Ese usuario ya está en uso. Selecciona otro", groups={"register"})
 */
class User extends BaseParentRecipe implements AdvancedUserInterface
{
    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=100,nullable=false,unique=true)
     */
    protected $username;

    /**
     * @var string $usernameCanonical
     *
     * @ORM\Column(name="username_canonical", type="string", length=100,nullable=false)
     */
    protected $usernameCanonical;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string $emailCaonical
     *
     * @ORM\Column(name="email_canonical", type="string", length=255)
     */
    protected $emailCanonical;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100,nullable=true)
     */
    protected $name;

    /**
     * @var string $surname
     *
     * @ORM\Column(name="surname", type="string", length=255,nullable=true)
     */
    protected $surname;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string",nullable=true)
     */
    protected $path;

    /**
     * @var boolean $newsletter
     *
     * @ORM\Column(name="newsletter", type="boolean",nullable=true)
     * @Assert\Type(type="bool")
     */
    protected $newsletter;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\Type(type="bool")
     */
    protected $enabled;

    /**
     * @var string salt
     *
     * @ORM\Column(name="salt", type="string", length=255,nullable=true)
     */
    protected $salt;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255,nullable=true)
     * @Assert\NotBlank(groups={"register"})
     * @Assert\Length(min = 6)
     */
    protected $password;

    /**
     * @var \Datetime $lastLogin
     *
     * @ORM\Column(name="last_login", type="datetime")
     * @Assert\DateTime()
     */
    protected $lastLogin;

    /**
     * @var string $confirmationToken
     *
     * @ORM\Column(name="confirmation_token", type="string", length=255,nullable=true)
     */
    protected $confirmationToken;

    /**
     * @var string $passwordToken
     *
     * @ORM\Column(name="password_token", type="string", length=255,nullable=true)
     */
    protected $passwordToken;

    /**
     * @var \Datetime $passwordRequestedAt
     *
     * @ORM\Column(name="password_requested_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $passwordRequestedAt;

    /**
     * @var boolean $locked
     *
     * @ORM\Column(name="locked", type="boolean")
     * @Assert\Type(type="bool")
     */
    protected $locked;

    /**
     * @var boolean $expired
     *
     * @ORM\Column(name="expired", type="boolean")
     * @Assert\Type(type="bool")
     */
    protected $expired;

    /**
     * @var \Datetime $expiresAt
     *
     * @ORM\Column(name="expires_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $expiresAt;

    public function __construct()
    {
        parent::__construct();
        $this->enabled    = false;
        $this->locked     = false;
        $this->expired    = false;
        $this->newsletter = false;
        $this->favorites  = new ArrayCollection();
    }

    public function eraseCredentials() {

    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->username;
    }

    public function isAccountNonExpired() {
        return !$this->getExpired();
    }

    public function isAccountNonLocked() {
        return !$this->getLocked();
    }

    public function isCredentialsNonExpired() {
        return !$this->getExpired();
    }

    public function isEnabled() {
        return $this->getEnabled();
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set usernameCanonical
     *
     * @param string $usernameCanonical
     * @return User
     */
    public function setUsernameCanonical($usernameCanonical)
    {
        $this->usernameCanonical = $usernameCanonical;

        return $this;
    }

    /**
     * Get usernameCanonical
     *
     * @return string
     */
    public function getUsernameCanonical()
    {
        return $this->usernameCanonical;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set emailCanonical
     *
     * @param string $emailCanonical
     * @return User
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    /**
     * Get emailCanonical
     *
     * @return string
     */
    public function getEmailCanonical()
    {
        return $this->emailCanonical;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     * @return User
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     * @return User
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set passwordToken
     *
     * @param string $passwordToken
     * @return User
     */
    public function setPasswordToken($passwordToken)
    {
        $this->passwordToken = $passwordToken;

        return $this;
    }

    /**
     * Get passwordToken
     *
     * @return string
     */
    public function getPasswordToken()
    {
        return $this->passwordToken;
    }

    /**
     * Set passwordRequestedAt
     *
     * @param \DateTime $passwordRequestedAt
     * @return User
     */
    public function setPasswordRequestedAt($passwordRequestedAt)
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    /**
     * Get passwordRequestedAt
     *
     * @return \DateTime
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     * @return User
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set expired
     *
     * @param boolean $expired
     * @return User
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return boolean
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     * @return User
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return User
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

}
