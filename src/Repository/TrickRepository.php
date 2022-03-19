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

    public function findCategoryByTrick(int $categoryId)
    {
        return $this->createQueryBuilder('t')
                    ->innerJoin('t.category', 'ca')
                    ->where('ca.id = :id')
                    ->setParameter('id', $categoryId)
                    ->orderBy('ca.id', 'DESC')
                    ->getQuery()
                    ->getResult();
    }
}