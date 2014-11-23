<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseSlug;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\RecipeRepository")
 */

class Recipe extends BaseSlug
{
    /**
     * @var string $title
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $title;

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
     * @var integer $calories
     *
     * @ORM\Column(name="calories",type="integer")
     */
    protected $calories;

    /**
     * @var integer $score
     *
     * @ORM\Column(name="score", type="integer")
     */
    protected $score;

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
     * @ORM\JoinColumn(name="kind_of_food_id", referencedColumnName="id", onDelete="CASCADE")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\IngredientMeasurement", mappedBy="ingredient_measurament", cascade={"all"})
     */
    protected $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pictures    = new ArrayCollection();
        $this->comments    = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string $title
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
     * Set description
     *
     * @param  string $description
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
     * Set vegan
     *
     * @param  boolean $vegan
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
     * @param  boolean $visible
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
     * @param  \AppBundle\Entity\Difficulty $difficulty
     * @return Recipe
     */
    public function setDifficulty(Difficulty $difficulty = null)
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
     * @param  \AppBundle\Entity\Nationality $nationality
     * @return Recipe
     */
    public function setNationality(Nationality $nationality = null)
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
     * @param  \AppBundle\Entity\KindOfFood $kindOfFood
     * @return Recipe
     */
    public function setKindOfFood(KindOfFood $kindOfFood = null)
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
     * @param  \AppBundle\Entity\Picture $picture
     * @return Recipe
     */
    public function addPicture(Picture $picture)
    {
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \AppBundle\Entity\Picture $picture
     */
    public function removePicture(Picture $picture)
    {
        $this->pictures->removeElement($picture);
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
     * Set quantityOfPeople
     *
     * @param  integer $quantityOfPeople
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
     * Set calories
     *
     * @param  integer $calories
     * @return Recipe
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set score
     *
     * @param  integer $score
     * @return Recipe
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get calories
     *
     * @return integer
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * Add comment
     *
     * @param  \AppBundle\Entity\Comment $comment
     * @return Recipe
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
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

    /**
     * Set user
     *
     * @param  \AppBundle\Entity\User $user
     * @return Recipe
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set difficulty
     *
     * @param  \AppBundle\Entity\Category $category
     * @return Recipe
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add ingredient
     *
     * @param  IngredientMeasurement $ingredient
     * @return Recipe
     */
    public function addIngredient(IngredientMeasurement $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param IngredientMeasurement $ingredient
     */
    public function removeIngredient(IngredientMeasurement $ingredient)
    {
        $this->comments->removeElement($ingredient);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
}
