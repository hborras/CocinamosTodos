<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 13:47
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityManager;

class RecipeManager implements RecipeManagerInterface {

    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class){
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class =  $metadata->getName();
    }

     /**
      * @return mixed
      */
     public function createRecipe()
     {
         $class = $this->class;
         $recipe = new $class;
         return $recipe;
     }

     /**
      * @param Recipe $recipe
      * @return mixed
      */
     public function deleteRecipe(Recipe $recipe)
     {
         $this->em->remove($recipe);
         $this->em->flush();
     }

     public function updateRecipe(Recipe $recipe)
     {
         // TODO: Implement updateRecipe() method
     }

     public function getClass()
     {
         return $this->class;
     }

     public function saveRecipe(Recipe $recipe){
         $this->em->persist($recipe);
         $this->em->flush();
     }

    public function findRecipes(){
        return $this->repository->findAllRecipe();
    }

    public function findRecipeBySlug($slug)
    {
        // TODO: Implement findRecipeBySlug() method.
    }
 }