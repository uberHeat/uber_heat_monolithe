<?php

namespace App\Repository;

use App\Entity\CircularDim;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CircularDim|null find($id, $lockMode = null, $lockVersion = null)
 * @method CircularDim|null findOneBy(array $criteria, array $orderBy = null)
 * @method CircularDim[]    findAll()
 * @method CircularDim[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CircularDimRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CircularDim::class);
    }

    // /**
    //  * @return CircularDim[] Returns an array of CircularDim objects
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
    public function findOneBySomeField($value): ?CircularDim
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
