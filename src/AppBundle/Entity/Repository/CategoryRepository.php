<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function queryAllCategory() {
        $em = $this->getEntityManager();

        $consulta = $em->createQuery('
            SELECT c
            FROM AppBundle:Category c
            ORDER BY c. ASC
        ');

        $consulta->useResultCache(true, 3600);

        return $consulta;
    }

}