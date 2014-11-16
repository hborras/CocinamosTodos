<?php

namespace AppBundle\Entity\Repository\Interfaces;

interface CategoryRepositoryInterface
{
    /**
     * Function for get all categories in Backend
     *
     * @param $root
     * @return mixed
     */
    public function queryAllCategory($root);

    /**
     * Function for get all categories in Backend
     *
     * @param $root
     * @return mixed
     */
    public function findAllCategory($root);

    /**
     * Function to get all categories in FrontEnd
     *
     * @param $root
     * @return mixed
     */
    public function queryVisibleCategory($root);

    /**
     * Function to get all categories in FrontEnd
     *
     * @param $root
     * @return mixed
     */
    public function findVisibleCategory($root);
}
