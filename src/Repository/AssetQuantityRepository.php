<?php

namespace App\Repository;

use App\Entity\AssetQuantity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetQuantity|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetQuantity|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetQuantity[]    findAll()
 * @method AssetQuantity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetQuantityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetQuantity::class);
    }

    // /**
    //  * @return AssetQuantity[] Returns an array of AssetQuantity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssetQuantity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
