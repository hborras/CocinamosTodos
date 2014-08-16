<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User implements AdvanceUserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
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
     * @ORM\Column(name="email_canonical", type="string", length=255, unique=true)
     */
    protected $emailCanonical;
    
    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100,nullable=true)
     */
    protected $name;
    
    /**
     * @var string surname
     *
     * @ORM\Column(name="surname", type="string", length=255,nullable=true)
     */
    protected $surname;
    
    /**
     *  @var string avatarRoute
     * 
     * @ORM\Column(name="avatar_route" type="string",nullable=true)
     */
    protected $avatarRoute;
    
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
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $createdAt;
    
    /**
     * @var datetime $lastLogin
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
     * @var datetime $passwordRequestedAt
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
     * @var datetime $expiresAt
     *
     * @ORM\Column(name="expires_at", type="datetime")
     * @Assert\DateTime()
     */
    protected $expiresAt;
    
    public function __construct()
    {
        $this->enabled    = false;
        $this->locked     = false;
        $this->expired    = false;
        $this->newsletter = false;
    }
}