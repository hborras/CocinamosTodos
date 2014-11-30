<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 14:04
 */

namespace AppBundle\Entity;

interface NationalityManagerInterface {

    /**
     * @param Nationality $nationality
     * @return data
     */
    public function uploadPicture(Nationality $nationality);

    /**
     * @return mixed
     */
    public function createNationality();

    /**
     * @param Nationality $nationality
     * @return mixed
     */
    public function deleteNationality(Nationality $nationality);

    public function updateNationality(Nationality $nationality);

    public function getClass();

    public function saveNationality(Nationality $nationality);

    public function findNationalities();

    public function findNationalityBySlug($slug);


} 