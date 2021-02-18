<?php

namespace App\Repository;

use App\Entity\RectangleDim;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RectangleDim|null find($id, $lockMode = null, $lockVersion = null)
 * @method RectangleDim|null findOneBy(array $criteria, array $orderBy = null)
 * @method RectangleDim[]    findAll()
 * @method RectangleDim[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RectangleDimRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RectangleDim::class);
    }

    // /**
    //  * @return RectangleDim[] Returns an array of RectangleDim objects
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
    public function findOneBySomeField($value): ?RectangleDim
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
