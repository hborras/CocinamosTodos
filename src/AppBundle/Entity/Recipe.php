<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RecipeRepository")
 */

class Recipe {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @var string $slug
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $slug;

    /**
     * @var string $description
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $description;

    /**
     * @var integer $quantityOfPeople
     *
     * @ORM\Column(name="quantity_of_people",type="integer")
     * @Assert\NotBlank()
     */
    protected $quantityOfPeople;

    /**
     * @var datetime createdAt
     *
     * @ORM\Column(name="created_at",type="datetime")
     * @Assert\Datetime()
     */
    protected $createdAt;

    /**
     * @var datetime modifiedAt
     *
     * @ORM\Column(name="modified_at",type="datetime")
     * @Assert\Datetime()
     */
    protected $modifiedAt;

    /**
     * @var boolean $vegan
     *
     * @ORM\Column(name="vegan", type="boolean")
     * @Assert\Type(type="bool")
     */
    protected $vegan;

    /**
     * @var boolean $visible
     *
     * @ORM\Column(name="visible", type="boolean")
     * @Assert\Type(type="bool")
     */
    protected $visible;

    /**
     * @var integer $difficulty
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Difficulty")
     * @ORM\JoinColumn(name="difficulty_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\Difficulty")
     */
    protected $difficulty;

    /**
     * @var integer $nationality
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Nationality")
     * @ORM\JoinColumn(name="nationality_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\Nationality")
     */
    protected $nationality;

    /**
     * @var integer $kindOfFood
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\KindOfFood")
     * @ORM\JoinColumn(name="kindOfFood_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\KindOfFood")
     */
    protected $kindOfFood;

    /**
     * @ORM\OneToMany (targetEntity="AppBundle\Entity\Picture", mappedBy="recipe", cascade={"all"})
     */
    protected $pictures;

    /**
     * @ORM\OneToMany (targetEntity="AppBundle\Entity\Comment", mappedBy="recipe", cascade={"all"})
     */
    protected $comments;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->picture = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Recipe
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Recipe
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Recipe
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     * @return Recipe
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set vegan
     *
     * @param boolean $vegan
     * @return Recipe
     */
    public function setVegan($vegan)
    {
        $this->vegan = $vegan;

        return $this;
    }

    /**
     * Get vegan
     *
     * @return boolean
     */
    public function getVegan()
    {
        return $this->vegan;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Recipe
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set difficulty
     *
     * @param \AppBundle\Entity\Difficulty $difficulty
     * @return Recipe
     */
    public function setDifficulty(\AppBundle\Entity\Difficulty $difficulty = null)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return \AppBundle\Entity\Difficulty
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set nationality
     *
     * @param \AppBundle\Entity\Nationality $nationality
     * @return Recipe
     */
    public function setNationality(\AppBundle\Entity\Nationality $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \AppBundle\Entity\Nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set kindOfFood
     *
     * @param \AppBundle\Entity\KindOfFood $kindOfFood
     * @return Recipe
     */
    public function setKindOfFood(\AppBundle\Entity\KindOfFood $kindOfFood = null)
    {
        $this->kindOfFood = $kindOfFood;

        return $this;
    }

    /**
     * Get kindOfFood
     *
     * @return \AppBundle\Entity\KindOfFood
     */
    public function getKindOfFood()
    {
        return $this->kindOfFood;
    }

    /**
     * Add picture
     *
     * @param \AppBundle\Entity\Picture $picture
     * @return Recipe
     */
    public function addPicture(\AppBundle\Entity\Picture $picture)
    {
        $this->picture[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \AppBundle\Entity\Picture $picture
     */
    public function removePicture(\AppBundle\Entity\Picture $picture)
    {
        $this->picture->removeElement($picture);
    }

    /**
     * Get picture
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set quantityOfPeople
     *
     * @param integer $quantityOfPeople
     * @return Recipe
     */
    public function setQuantityOfPeople($quantityOfPeople)
    {
        $this->quantityOfPeople = $quantityOfPeople;

        return $this;
    }

    /**
     * Get quantityOfPeople
     *
     * @return integer
     */
    public function getQuantityOfPeople()
    {
        return $this->quantityOfPeople;
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\Comment $comments
     * @return Recipe
     */
    public function addComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\Comment $comments
     */
    public function removeComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}