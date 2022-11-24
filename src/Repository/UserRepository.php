<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // TO DO - zmienić nazwę tej metody
    public function getActive()
    {
        // Pobranie wszystkich zalogowanych obecnie użytkowników
        $delay = new \DateTime();
        $delay->setTimestamp(strtotime('2 minutes ago'));

        $qb = $this->createQueryBuilder('u');
        $qb->select('u.username AS username')
            ->where('u.lastActivityAt > :delay')
            ->setParameter('delay', $delay)
        ;
        return $qb->getQuery()->getResult();
    }

    // pobranie statystyk łączynych ze wszystkich sezonów - RANKING
    public function getRanking(){

        $sql = 'SELECT '
            .'u.username AS username, '
            .'u.status AS status, '
            .'(sum(s.total_points) / sum(s.num_of_que)) AS avgPtsForMatch, '
            .'count(u.id) AS seasons, '
            .'sum(s.num_of_que) AS numOfQue, '
            .'sum(s.total_points) AS totalpoints, '
            .'sum(s.match2) AS match2, '
            .'sum(s.match4) AS match4, '
            .'sum(if(s.position=1,1,0)) AS wins, '
            .'sum(if(s.position=2,1,0)) AS secondplaces, '
            .'sum(if(s.position=3,1,0)) AS thirdplaces, '
            .'sum(if(s.position=4,1,0)) AS fourthplaces, '
            .'sum(if(s.position=5,1,0)) AS fiveplaces, '
            .'sum(if(s.position=6,1,0)) AS sixthplaces, '
            .'sum(if(s.position=7,1,0)) AS seventhplaces, '
            .'sum(if(s.position=8,1,0)) AS eightplaces, '
            .'sum(if(s.position=9,1,0)) AS nineplaces, '
            .'sum(if(s.position=10,1,0)) AS tenplaces, '
            .'sum(if(s.position>10,1,0)) AS others '
            .'FROM user u '
            .'LEFT JOIN statistic s ON s.user_id = u.id '
            .'GROUP BY u.username, u.status '
            .'ORDER BY wins DESC,secondplaces DESC,'
            . 'thirdplaces DESC, fourthplaces DESC, fiveplaces DESC, '
            . 'sixthplaces DESC, seventhplaces DESC, eightplaces DESC, '
            . 'nineplaces DESC, tenplaces DESC '
        ;

        $rank = $this->getEntityManager()->getConnection()->executeQuery($sql)->fetchAll();

        return $rank;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
