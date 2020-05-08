<?php

namespace App\Repository;

use App\Entity\International;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method International|null find($id, $lockMode = null, $lockVersion = null)
 * @method International|null findOneBy(array $criteria, array $orderBy = null)
 * @method International[]    findAll()
 * @method International[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternationalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, International::class);
    }

    // /**
    //  * @return International[] Returns an array of International objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?International
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
