<?php

namespace App\Repository;

use App\Entity\Prouit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Prouit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prouit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prouit[]    findAll()
 * @method Prouit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProuitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prouit::class);
    }

    // /**
    //  * @return Prouit[] Returns an array of Prouit objects
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
    public function findOneBySomeField($value): ?Prouit
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
