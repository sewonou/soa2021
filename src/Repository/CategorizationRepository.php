<?php

namespace App\Repository;

use App\Entity\Categorization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorization|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorization|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorization[]    findAll()
 * @method Categorization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorizationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorization::class);
    }

    // /**
    //  * @return Categorization[] Returns an array of Categorization objects
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
    public function findOneBySomeField($value): ?Categorization
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
