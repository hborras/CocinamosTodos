<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Repository\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{
    public function queryAllCategory($root = false)
    {
        $em = $this->getEntityManager();

        $dql = 'SELECT c
            FROM AppBundle:Category c ';
        if ($root) {
            $dql.='WHERE c.parent is NULL ';
        }
        $dql.='ORDER BY c.order ASC';
        $query = $em->createQuery($dql);

        $query->useResultCache(true, 3600);

        return $query;
    }

    public function findAllCategory($root = false)
    {
        return $this->queryAllCategory($root)->getResult();
    }

    /**
     * Function to get all categories in FrontEnd
     *
     * @param $root
     * @return mixed
     */
    public function queryVisibleCategory($root)
    {
        // TODO: Implement queryVisibleCategory() method.
    }

    /**
     * Function to get all categories in FrontEnd
     *
     * @param $root
     * @return mixed
     */
    public function findVisibleCategory($root)
    {
        // TODO: Implement findVisibleCategory() method.
    }
}
