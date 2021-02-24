<?php

namespace App\Repository;

use App\Entity\RecipeComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeComment[]    findAll()
 * @method RecipeComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeComment::class);
    }

    // /**
    //  * @return RecipeComment[] Returns an array of RecipeComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecipeComment
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
