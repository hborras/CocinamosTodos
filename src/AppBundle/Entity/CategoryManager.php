<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 13:47
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityManager;

class CategoryManager implements CategoryManagerInterface {

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
     public function createCategory()
     {
         $class = $this->class;
         $category = new $class;
         return $category;
     }

     /**
      * @param Category $category
      * @return mixed
      */
     public function deleteCategory(Category $category)
     {
         $this->em->remove($category);
         $this->em->flush();
     }

     public function updateCategory(Category $category)
     {
         // TODO: Implement updateCategory() method
     }

     public function getClass()
     {
         return $this->class;
     }

     public function saveCategory(Category $category){
         $this->em->persist($category);
         $this->em->flush();
     }

    public function findCategories($root){
        return $this->repository->findAllCategory($root);
    }

    public function findCategoryBySlug($slug)
    {
        // TODO: Implement findCategoryBySlug() method.
    }
 }