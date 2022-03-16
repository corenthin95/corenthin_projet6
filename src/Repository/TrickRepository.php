<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    public function findCategoryByTrick(int $trickId)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t, c
            FROM App\Entity\Trick t
            INNER JOIN t.category c
            WHERE t.id = :id'
        )->setParameter('id', $trickId);

        return $query->getOneOrNullResult();
    }
}