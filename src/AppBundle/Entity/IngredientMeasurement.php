<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 26/10/14
 * Time: 13:10
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Base;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="ingredient_measurement")
 * @ORM\Entity()
 */

class IngredientMeasurement extends Base {

    /**
     * @var integer $ingredient
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredient")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\Ingredient")
     */
    protected $ingredient;

    /**
     * @var integer $measurement
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UnitOfMeasurement")
     * @ORM\JoinColumn(name="measurement_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\UnitOfMeasurement")
     */
    protected $measurement;

    /**
     * @var integer $recipe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type("AppBundle\Entity\Recipe")
     */
    protected $recipe;

    /**
     * @ORM\Column(name="quantity",type="string")
     */
    protected $quantity;

    /**
     * Set ingredient
     *
     * @param Ingredient $ingredient
     * @return IngredientMeasurement
     */
    public function setIngredient(Ingredient $ingredient = null)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return Ingredient
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set measurement
     *
     * @param UnitOfMeasurement $measurement
     * @return IngredientMeasurement
     */
    public function setMeasurement(UnitOfMeasurement $measurement = null)
    {
        $this->measurement = $measurement;

        return $this;
    }

    /**
     * Get measurement
     *
     * @return UnitOfMeasurement
     */
    public function getMeasurement()
    {
        return $this->measurement;
    }

    /**
     * Set recipe
     *
     * @param Recipe $recipe
     * @return IngredientMeasurement
     */
    public function setRecipe(Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
