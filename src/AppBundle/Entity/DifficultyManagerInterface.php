<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 14:04
 */

namespace AppBundle\Entity;

interface DifficultyManagerInterface {

    /**
     * @return mixed
     */
    public function createDifficulty();

    /**
     * @param Difficulty $difficulty
     * @return mixed
     */
    public function deleteDifficulty(Difficulty $difficulty);

    public function updateDifficulty(Difficulty $difficulty);

    public function getClass();

    public function saveDifficulty(Difficulty $difficulty);

    public function findDifficulties();

    public function findDifficultyBySlug($slug);


} 