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

    public function getMoreTricks(int $page, int $limit = 8)
    {
        return $this->createQueryBuilder('t')
                    ->orderBy('t.id', 'DESC')
                    ->setFirstResult(($page - 1) * $limit)
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }
}