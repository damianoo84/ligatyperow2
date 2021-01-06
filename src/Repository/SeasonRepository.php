<?php

namespace App\Repository;

use App\Entity\Season;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Season|null find($id, $lockMode = null, $lockVersion = null)
 * @method Season|null findOneBy(array $criteria, array $orderBy = null)
 * @method Season[]    findAll()
 * @method Season[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Season::class);
    }

    // pobranie obecnego sezonu
    public function getSeason() {
        $today = new \DateTime('now');
        $qb = $this->createQueryBuilder('s');
        $qb->select('s.id AS season_id')
            ->where('s.dateEnd > :today')
            ->setMaxResults(1)
            ->setParameter('today', $today->format('Y-m-d'))
        ;

        $result = $qb->getQuery()->getOneOrNullResult();

        return $result['season_id'];
    }

    // pobranie ostatniego sezonu
    public function getLastSeason(){

        $qb = $this->createQueryBuilder('s');
        $qb->select('max(s.id) AS last');

        $result = $qb->getQuery()->getOneOrNullResult();

        return $result['last'];
    }


    // /**
    //  * @return Season[] Returns an array of Season objects
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
    public function findOneBySomeField($value): ?Season
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
