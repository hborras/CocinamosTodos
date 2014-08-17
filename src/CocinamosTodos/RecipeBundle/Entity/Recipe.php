<?php

namespace CocinamosTodos\RecipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="CocinamosTodos\RecipeBundle\Entity\RecipeRepository")
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
     * @ORM\ManyToOne(targetEntity="CocinamosTodos\RecipeBundle\Entity\Difficulty")
     * @ORM\JoinColumn(name="difficulty_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("CocinamosTodos\RecipeBundle\Entity\Difficulty")
     */
    protected $difficulty;
    
    /**
     * @var integer $nationality
     *
     * @ORM\ManyToOne(targetEntity="CocinamosTodos\NationalityBundle\Entity\Nationality")
     * @ORM\JoinColumn(name="nationality_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("CocinamosTodos\NationalityBundle\Entity\Nationality")
     */
    protected $nationality;
    
     /**
     * @var integer $kindOfFood
     *
     * @ORM\ManyToOne(targetEntity="CocinamosTodos\KindOfFoodBundle\Entity\KindOfFood")
     * @ORM\JoinColumn(name="kindOfFood_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("CocinamosTodos\KindOfFoodBundle\Entity\KindOfFood")
     */
    protected $kindOfFood;
    
    /**
     * @ORM\OneToMany (targetEntity="CocinamosTodos\RecipeBundle\Entity\Picture", mappedBy="recipe", cascade={"all"})
     */
    protected $picture;
    
    
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
     * @param \CocinamosTodos\RecipeBundle\Entity\Difficulty $difficulty
     * @return Recipe
     */
    public function setDifficulty(\CocinamosTodos\RecipeBundle\Entity\Difficulty $difficulty = null)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return \CocinamosTodos\RecipeBundle\Entity\Difficulty 
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set nationality
     *
     * @param \CocinamosTodos\NationalityBundle\Entity\Nationality $nationality
     * @return Recipe
     */
    public function setNationality(\CocinamosTodos\NationalityBundle\Entity\Nationality $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \CocinamosTodos\NationalityBundle\Entity\Nationality 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set kindOfFood
     *
     * @param \CocinamosTodos\KindOfFoodBundle\Entity\KindOfFood $kindOfFood
     * @return Recipe
     */
    public function setKindOfFood(\CocinamosTodos\KindOfFoodBundle\Entity\KindOfFood $kindOfFood = null)
    {
        $this->kindOfFood = $kindOfFood;

        return $this;
    }

    /**
     * Get kindOfFood
     *
     * @return \CocinamosTodos\KindOfFoodBundle\Entity\KindOfFood 
     */
    public function getKindOfFood()
    {
        return $this->kindOfFood;
    }

    /**
     * Add picture
     *
     * @param \CocinamosTodos\RecipeBundle\Entity\Picture $picture
     * @return Recipe
     */
    public function addPicture(\CocinamosTodos\RecipeBundle\Entity\Picture $picture)
    {
        $this->picture[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \CocinamosTodos\RecipeBundle\Entity\Picture $picture
     */
    public function removePicture(\CocinamosTodos\RecipeBundle\Entity\Picture $picture)
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
}
