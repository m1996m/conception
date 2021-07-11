<?php

namespace App\Repository;

use App\Entity\Patient2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Patient2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient2[]    findAll()
 * @method Patient2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Patient2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient2::class);
    }

    // /**
    //  * @return Patient2[] Returns an array of Patient2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Patient2
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
