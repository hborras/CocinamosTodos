<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 13:47
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityManager;

class DifficultyManager implements DifficultyManagerInterface {

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
     public function createDifficulty()
     {
         $class = $this->class;
         $difficulty = new $class;
         return $difficulty;
     }

     /**
      * @param Difficulty $difficulty
      * @return mixed
      */
     public function deleteDifficulty(Difficulty $difficulty)
     {
         $this->em->remove($difficulty);
         $this->em->flush();
     }

     public function updateDifficulty(Difficulty $difficulty)
     {
         // TODO: Implement updateDifficulty() method
     }

     public function getClass()
     {
         return $this->class;
     }

     public function saveDifficulty(Difficulty $difficulty){
         $this->em->persist($difficulty);
         $this->em->flush();
     }

    public function findDifficulties(){
        return $this->repository->findAllDifficulty();
    }

    public function findDifficultyBySlug($slug)
    {
        // TODO: Implement findDifficultyBySlug() method.
    }
 }