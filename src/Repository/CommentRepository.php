<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    // pobranie komentarzy po ID sezonu
    public function getCommentsBySeason($season){
        $qb = $this->createQueryBuilder('c');
        $qb->select(
            'c.text AS text'
            ,'c.created AS createdAt'
            ,'s.id AS season_id'
            ,'u.username AS username'
        )
            ->innerJoin('c.season', 's')
            ->innerJoin('c.user', 'u')
            ->where('s.id = :season')
            ->setParameter('season', $season)
            ->orderBy('c.id','DESC')
        ;

        $result = $qb->getQuery()->getResult();
//        exit(\Doctrine\Common\Util\Debug::dump($result));

        return $result;

    }

}
