<?php

namespace App\Repository;

use App\Entity\Matchday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Matchday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matchday[]    findAll()
 * @method Matchday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchdayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Matchday::class);
    }

    // /**
    //  * @return Matchday[] Returns an array of Matchday objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Matchday
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
