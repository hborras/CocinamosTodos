<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class DifficultyRepository extends EntityRepository
{
    public function queryAllDifficulty()
    {
        $em = $this->getEntityManager();

        $dql = 'SELECT d
            FROM AppBundle:Difficulty d ';
        $dql.='ORDER BY d.name ASC';
        $query = $em->createQuery($dql);

        $query->useResultCache(true, 3600);

        return $query;
    }

    public function findAllDifficulty()
    {
        return $this->queryAllDifficulty()->getResult();
    }
}
