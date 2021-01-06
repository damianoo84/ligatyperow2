<?php

namespace App\Repository;

use App\Entity\Meet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Meet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meet[]    findAll()
 * @method Meet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meet::class);
    }

    // pobranie meczy na dana kolejke
    public function getMeetsPerMatchday($matchday){
        $qb = $this->createQueryBuilder('m');
        $qb->select(
            'm.id AS meet_id'
            ,'tm1.name AS host'
            ,'tm1.shortname AS hostShort'
            ,'tm2.name AS guest'
            ,'tm2.shortname AS guestShort'
            ,'l.name AS league'
            ,'m.term'
            ,'md.id AS matchday_id'
        )
            ->innerJoin('m.hostTeam', 'tm1')
            ->innerJoin('m.guestTeam', 'tm2')
            ->innerJoin('m.league', 'l')
            ->innerJoin('m.matchday', 'md')
            ->where('md.id = :matchday')
            ->orderBy('m.id')
            ->setParameter('matchday', $matchday)
        ;

        $result = $qb->getQuery()->getResult();

        return $result;

    }

    // pobranie wszystkich meczy ze wszystkich kolejek
    public function getMeetsPerMatchday1to15(){
        $qb = $this->createQueryBuilder('m');
        $qb->select(
            'm.id AS meet_id'
            ,'md.id AS matchday'
        )
            ->innerJoin('m.matchday', 'md')
            ->where('md.id BETWEEN 1 AND 15')
            ->orderBy('m.id')
        ;

        $result = $qb->getQuery()->getResult();

        return $result;

    }

    // /**
    //  * @return Meet[] Returns an array of Meet objects
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
    public function findOneBySomeField($value): ?Meet
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
