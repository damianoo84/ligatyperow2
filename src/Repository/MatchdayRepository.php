<?php

namespace App\Repository;

use App\Entity\Matchday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Matchday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matchday[]    findAll()
 * @method Matchday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchdayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matchday::class);
    }

    // pobranie obecnej kolejki
    public function getMatchday() {
        $today = new \DateTime('now');
        $qb = $this->createQueryBuilder('m');
        $qb->select('m.id AS id'
            ,'m.name AS name'
            ,'m.dateFrom AS dateFrom'
            ,'m.dateTo AS dateTo'
            ,'s.id AS season_id'
        )
            ->innerJoin('m.season', 's')
            ->where('m.dateFrom > :today')
            ->setMaxResults(1)
            ->setParameter('today', $today->format('Y-m-d H:i:s'))
        ;

        $result = $qb->getQuery()->getOneOrNullResult();

//        exit(\Doctrine\Common\Util\Debug::dump($result));

        return $result;
    }

    public function getPreviuosMatchday() {

        $today = new \DateTime('now');
        $qb = $this->createQueryBuilder('m');
        $qb->select('m.id AS id'
            ,'m.name AS name'
            ,'m.dateFrom AS dateFrom'
            ,'m.dateTo AS dateTo'
            ,'s.id AS season_id'
        )
            ->innerJoin('m.season', 's')
            ->where('m.dateFrom < :today')
            ->setMaxResults(1)
            ->setParameter('today', $today->format('Y-m-d H:i:s'))
        ;

        $result = $qb->getQuery()->getOneOrNullResult();

//        exit(\Doctrine\Common\Util\Debug::dump($result));

        return $result;



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
