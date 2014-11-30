<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 13:47
 */

namespace AppBundle\Entity;

use AppBundle\Utils\PictureBussiness;
use Doctrine\ORM\EntityManager;

class NationalityManager implements NationalityManagerInterface {

    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class){
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class =  $metadata->getName();
    }

    public function uploadPicture(Nationality $nationality){
        $pb = new PictureBussiness();
        $upload_data = $pb->uploadPicture('flag','flags',true,120,60);
        $data = json_decode($upload_data);
        if ($data->code== 0){
            if($nationality->getPath() != ""){
                $pb->remove_picture('flags/'.$nationality->getPath());
            }
            $nationality->setPath($data->filename);
        } else {
            return $data->code;
        }

    }

     /**
      * @return mixed
      */
     public function createNationality()
     {
         $class = $this->class;
         $nationality = new $class;
         return $nationality;
     }

     /**
      * @param Nationality $nationality
      * @return mixed
      */
     public function deleteNationality(Nationality $nationality)
     {
         $this->em->remove($nationality);
         $this->em->flush();
     }

     public function updateNationality(Nationality $nationality)
     {
         // TODO: Implement updateNationality() method
     }

     public function getClass()
     {
         return $this->class;
     }

     public function saveNationality(Nationality $nationality){
         $this->em->persist($nationality);
         $this->em->flush();
     }

    public function findNationalities(){
        return $this->repository->findAllNationality();
    }

    public function findNationalityBySlug($slug)
    {
        // TODO: Implement findNationalityBySlug() method.
    }
 }