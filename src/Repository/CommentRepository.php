<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findCommentByTrick(int $commentId)
    {
        return $this->createQueryBuilder('co')
                    ->innerJoin('co.trick', 't')
                    ->leftJoin('co.user', 'u')
                    ->where('t.id = :trick')
                    ->setParameter('trick', $commentId)
                    ->orderBy('co.createdAt', 'DESC')
                    ->getQuery()
                    ->getResult();
    }
}   
