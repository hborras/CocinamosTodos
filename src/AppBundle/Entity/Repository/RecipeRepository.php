<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class RecipeRepository extends EntityRepository
{
    public function queryAllRecipe($orderBy = 'r.createdAt',$sort = 'ASC')
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
            SELECT r
            FROM AppBundle:Recipe r
            ORDER BY '.$orderBy.' '.$sort
        );

        $query->useResultCache(true, 3600);

        return $query;
    }

    public function findAllRecipe()
    {
        return $this->queryAllRecipe()->getResult();
    }

    public function findRecipeBySlug($slug = "")
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
            SELECT r
            FROM AppBundle:Recipe r
            WHERE r.slug = :id
        ');

        $query->setParameter('slug',$slug);
        $query->useResultCache(true, 3600);

        return $query->getSingleResult();
    }

}
