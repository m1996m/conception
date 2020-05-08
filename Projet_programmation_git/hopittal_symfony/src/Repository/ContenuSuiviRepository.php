<?php

namespace App\Repository;

use App\Entity\ContenuSuivi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContenuSuivi|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenuSuivi|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenuSuivi[]    findAll()
 * @method ContenuSuivi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuSuiviRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenuSuivi::class);
    }

    // /**
    //  * @return ContenuSuivi[] Returns an array of ContenuSuivi objects
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
    public function findOneBySomeField($value): ?ContenuSuivi
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
