<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class NationalityRepository extends EntityRepository
{
    public function queryAllNationality()
    {
        $em = $this->getEntityManager();

        $dql = 'SELECT n
            FROM AppBundle:Nationality n ';
        $dql.='ORDER BY n.name ASC';
        $query = $em->createQuery($dql);

        $query->useResultCache(true, 3600);

        return $query;
    }

    public function findAllNationality()
    {
        return $this->queryAllNationality()->getResult();
    }
}
