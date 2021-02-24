<?php

namespace App\Repository;

use App\Entity\CommentComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentComment[]    findAll()
 * @method CommentComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentComment::class);
    }

    // /**
    //  * @return CommentComment[] Returns an array of CommentComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommentComment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
