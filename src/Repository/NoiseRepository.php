<?php

namespace App\Repository;

use App\Entity\Noise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Noise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Noise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Noise[]    findAll()
 * @method Noise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoiseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Noise::class);
    }

    // /**
    //  * @return Noise[] Returns an array of Noise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Noise
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
