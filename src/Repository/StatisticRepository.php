<?php

namespace App\Repository;

use App\Entity\Statistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statistic[]    findAll()
 * @method Statistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatisticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statistic::class);
    }

    public function getUserData($user){
        $qb = $this->createQueryBuilder('s');
        $qb->select(
            '(s.totalPoints/s.numOfQue) AS avgPtsForMatch'
            ,'se.name AS season'
            ,'s.numOfQue AS numOfQue'
            ,'s.totalPoints AS totalpoints'
            ,'s.match2 AS match2'
            ,'s.match4 AS match4'
        )
            ->innerJoin('s.season', 'se')
            ->where('s.user = :user')
            ->orderBy('s.season', 'DESC')
            ->setParameter('user', $user)
        ;

        /**
         * SELECT (total_points/num_of_que) AS avgPtsForMatch, season_id AS season,
         * num_of_que AS numOfQue, total_points AS totalpoints, match2 AS match2,
         * match4 AS match4 FROM statistic WHERE user_id = 1 ORDER BY avgPtsForMatch DESC
         *
         */

        $result = $qb->getQuery()->getResult();

        return $result;
    }

    // /**
    //  * @return Statistic[] Returns an array of Statistic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Statistic
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
