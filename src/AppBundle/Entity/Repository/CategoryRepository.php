<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
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

}
