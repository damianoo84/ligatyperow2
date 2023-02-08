<?php

namespace App\Repository;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Meet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    private $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Type::class);
        $this->logger = $logger;
    }

    // Pobranie sumy punktów każdego użytkownika dla każdej kolejki
    public function getPointsPerMatchday($matchdayId) {

        // Pobieram sumę punktów każdego użytkownika w każdej kolejce
        $sql = 'SELECT SUM(t.number_of_points) AS suma, u.username, u.id AS user_id, md.id AS matchday '
            . 'FROM user u '
            . 'LEFT JOIN type t ON t.user_id = u.id '
            . 'LEFT JOIN meet m ON t.meet_id = m.id '
            . 'LEFT JOIN matchday md ON m.matchday_id = md.id '
            . 'WHERE u.STATUS = :status '
            . ' GROUP BY u.username, md.id, u.id '
            . 'ORDER BY u.id, md.id ';
        $params = array('status' => 1);
        $result = $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();

        // pobieram aktywnych uzytkownikow
        $userRepo = $this->getEntityManager()->getRepository(User::class);
        $usr = $userRepo->findByStatus(1);

        // tworze tablice gdzie kluczem jest id usera a wartoscia jego nazwa
        // 04-02-2023 zmodyfikowałem tak żeby możliwe było dodane innych informacji o użytkowniku (np. pozycja w rankingu
        $users = array();
        foreach ($usr as $us){
            $users[$us->getId()]['username'] = $us->getUsername();
            $users[$us->getId()]['ranking'] = $us->getRankingPosition();
            $users[$us->getId()]['lastWinner'] = $us->getLastWinner();
            $users[$us->getId()]['liderOfRanking'] = $us->getLiderOfRanking();
        }

        // iteruje po aktualnej liczbie kolejek
        for ($i=1;$i<=$matchdayId;$i++) {

            // iteruje po aktywnych uzytkownikach
            foreach ($users as $key => $value) {

                // trzeba ustawic poczatkowa wartosc w tablicy dla pola sumaAll
                if (!isset($points_per_matchday[$key])) {
                    $points_per_matchday[$key]['sumaAll'] = 0;
                }

                $userTypeStatus = false; // ustawiam w celu sprawdzenia czy dany user wytypowal juz w danej kolejce
                $sumaAll = 0; // ustawiam poczatkowa wartosc dla zmiennej do ktorej bede dopisywal kolejne sumy punktow

                // iteruje po tablicy z punktami uzytkownikow w kazdej kolejce
                foreach ($result as $details) {

                    // jesli dany uzytkownik wytypowal w danej koleje to koncze iterowac i
                    // ustawiam status na TRUE oraz dopisuje sume punktow z danej kolejki
                    if (($key == $details['user_id']) && ($details['matchday'] == $i)) {
                        $points_per_matchday[$details['user_id']]['username'] = $details['username'];
                        $points_per_matchday[$details['user_id']]['suma'][] = (int) $details['suma'];
                        $points_per_matchday[$details['user_id']]['lastWinner'] = $value['lastWinner'];
                        $points_per_matchday[$details['user_id']]['liderOfRanking'] = $value['liderOfRanking'];
                        $points_per_matchday[$details['user_id']]['ranking'] = $value['ranking'];
                        $userTypeStatus = true;
                        $sumaAll = (int) $details['suma'];
                        break;
                    }
                }

                // jesli po powyzszej iteracji nie zmienil sie status usera na TRUE to wiem ze
                // dany user nie typowal w danej kolejce
                // i w zwiazku z tym zapisuje pod jego imieniem sume punktow = 0
                if (!$userTypeStatus) {
                    $points_per_matchday[$key]['username'] = $value['username'];
                    $points_per_matchday[$key]['ranking'] = $value['ranking'];
                    $points_per_matchday[$key]['lastWinner'] = $value['lastWinner'];
                    $points_per_matchday[$key]['liderOfRanking'] = $value['liderOfRanking'];
                    $points_per_matchday[$key]['suma'][] = 0;
                }

                // tutaj sumuje koleje punkty z kazdej kolejki danego uzytkownika
                $points_per_matchday[$key]['sumaAll'] += $sumaAll;

            }

        }

        // sortujemy po sumie punktów
        arsort($points_per_matchday);

//         exit(\Doctrine\Common\Util\Debug::dump($points_per_matchday));
        return $points_per_matchday;
    }

    // pobranie sumy meczy za 2pkt i meczy za 4pkt (dla statystyk)
    public function getStatistics() {

        $qb = $this->createQueryBuilder('t');
        $qb->select(
            'u.id AS user_id'
            , 'u.username AS username'
            , 't.numberOfPoints AS point'
        )
            ->innerJoin('t.user', 'u')
        ;

        $result = $qb->getQuery()->getResult();

        $stats = array();

        foreach ($result as $details) {

            if (!isset($stats[$details['username']])) {
                $stats[$details['username']]['match2'] = 0;
                $stats[$details['username']]['match4'] = 0;
            }

            if ($details['point'] == 2) {
                $stats[$details['username']]['match2'] += 1;
            }

            if ($details['point'] == 4) {
                $stats[$details['username']]['match4'] += 1;
            }
        }

        return $stats;
    }

    // Uwaga! tutaj musiał być NativeSQL ponieważ zwykły QueryBuilder zwracał złe dane,
    // a potrzeba była złączenia entity User z entity Type w celu znalezienia tych userów
    // którzy jeszcze nie wytypowali
    public function getUsersTypes($matchday,$seasonId) {

        // 1. Pobieram typy użytkowników
        $sql = 'SELECT  '
            .'tm1.name AS host,  '
            .'tm1.shortname AS shortNameTm1,'
            .'tm2.name AS guest, '
            .'tm2.shortname AS shortNameTm2,'
            .'u.username AS username, '
            .'t.host_type AS hostType, '
            .'t.guest_type AS guestType,  '
            .'m.matchday_id, '
            .'m.host_goals AS hostGoals, '
            .'m.guest_goals AS guestGoals, '
            .'m.term AS term, '
            .'t.number_of_points AS numberOfPoints '
            .'FROM user u  '
            .'INNER JOIN type t ON t.user_id = u.id  '
            .'INNER JOIN meet m ON t.meet_id = m.id '
            .'INNER JOIN team tm1 ON m.host_team_id = tm1.id  '
            .'INNER JOIN team tm2 ON m.guest_team_id = tm2.id  '
            .'INNER JOIN matchday md ON m.matchday_id = md.id '
//                     .'INNER JOIN season s ON s.id = md.season_id '
//                     .'WHERE s.is_active = 1 '
            .'WHERE md.season_id = '.$seasonId
            .' ORDER BY u.id ';

        $params = array('matchday' => $matchday);
        $usersTypes = $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();

//         exit(\Doctrine\Common\Util\Debug::dump($usersTypes));
        
        // 2. Pobieram mecze w danej kolejce
        $meetRepo = $this->getEntityManager()->getRepository(Meet::class);
        $meets = $meetRepo->findByMatchday($matchday);

//        exit(\Doctrine\Common\Util\Debug::dump($meets));
        
        // 3. Pobieram wszystkich aktywnych użytkowników
        $userRepo = $this->getEntityManager()->getRepository(User::class);
        $users = $userRepo->findByStatus(1);

//        exit(\Doctrine\Common\Util\Debug::dump($users));
        
        $matrix = array();

        // jeśli zaplanowane już są jakieś mecze to:
        if($meets != NULL){

            // 4. Utworzenie macierzy gdzie klucze to nazwy meczy i nazwy użytkowników
            foreach($meets as $meet){
                foreach ($users as $user){

                    $names = $meet->getHostTeam()->getName() . "-" . $meet->getGuestTeam()->getName();
                    $shortNames = $meet->getHostTeam()->getShortname() . "-" . $meet->getGuestTeam()->getShortname();
                    $score =
                        (null!==$meet->getHostGoals()?$meet->getHostGoals():" ")
                        ." - "
                        .(null!==$meet->getGuestGoals()?$meet->getGuestGoals():" ");

                    # sklejenie krótkiej nazwy meczu, terminu, spotkania, wyniku
                    $hostGuest = $shortNames.$meet->getTerm().' | '.$names.' | '.$score;

                    $matrix[$hostGuest][$user->getUsername()] = '-';
                }
            }

//                    exit(\Doctrine\Common\Util\Debug::dump($matrix));
            
            // 5. Wypełnienie macierzy typami
            foreach ($usersTypes as $type){
                if($type['matchday_id'] == $matchday){

                    $names = $type['shortNameTm1'] . "-" . $type['shortNameTm2'];
                    $shortNames = $type['host'] . "-" . $type['guest'];
                    $score =
                        (null!==$type['hostGoals']?$type['hostGoals']:" ")
                        ." - "
                        .(null!==$type['guestGoals']?$type['guestGoals']:" ");

                    # sklejenie krótkiej nazwy meczu, terminu, spotkania, wyniku
                    $hostGuest = $names.$type['term'].' | '.$shortNames.' | '.$score;

                    $isPoints = ($type['numberOfPoints'] == NULL) ? "" : $type['numberOfPoints'];

                    $matrix[$hostGuest][$type['username']] = $type['hostType'] . ' - ' . $type['guestType'].' '.$isPoints;
                }
            }
        }
//        exit(\Doctrine\Common\Util\Debug::dump($matrix));

        return $matrix;
    }

    function getUserTypes($matchday, $user) {

        // Pobranie typów użytkownika
        $sql = 'SELECT tm1.name AS host, tm1.shortname AS hostShort, '
            . 'tm2.name AS guest, tm2.shortname AS guestShort, '
            . 't.host_type AS hostType,'
            . 't.guest_type AS guestType, l.name, m.term '
            . 'FROM user u '
            . 'LEFT JOIN type t ON t.user_id = u.id '
            . 'LEFT JOIN meet m ON m.id = t.meet_id '
            . 'LEFT JOIN team tm1 ON m.host_team_id = tm1.id '
            . 'LEFT JOIN team tm2 ON m.guest_team_id = tm2.id '
            . 'LEFT JOIN league l ON m.league_id = l.id '
            . 'LEFT JOIN matchday md ON md.id = m.matchday_id '
            . 'WHERE u.id = :user '
            . 'AND md.id = :matchday '
            . 'ORDER BY m.id ';
        $params = array('user' => $user, 'matchday' => $matchday);
        $userTypes = $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();

        return $userTypes;
    }

    public function getNoTypedUsersList($matchday) {

        // Pobranie listy telefonów użytkowników, którzy jeszcze nie podali typów
        $sql = 'SELECT u.phone, u.id '
            . 'FROM type t '
            . 'INNER JOIN user u ON t.user_id = u.id '
            . 'INNER JOIN meet m ON t.meet_id = m.id '
            . 'INNER JOIN matchday md ON m.matchday_id = md.id '
            . 'WHERE md.id = :matchday '
            . 'AND u.status = 1 '
            . 'GROUP BY u.id '
            . 'HAVING COUNT(t.user_id) > 0 ';
        $params = array('matchday' => $matchday);
        $userTypes = $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();

        // Pobieram wszystkich aktywnych użytkowników
        $userRepo = $this->getEntityManager()->getRepository(User::class);
        $users = $userRepo->findByStatus(1);

        $this->logger->info('DC $users: ' . $users);

        $phones = array();

        foreach ($userTypes as $userT) {
            $userIdTyped[] = $userT['phone'];
        }

        foreach($users as $user){
            $userIdAll[] = $user->getPhone();
        }

        $result = array_diff($userIdAll, $userIdTyped);

        foreach ($result as $res){
            $phones[] = $res;
        }

        return $phones;
    }

    function checkTypes($matchday) {

        //
        $sql = 'SELECT * FROM type t INNER JOIN meet m ON t.meet_id = m.id WHERE m.matchday_id = :matchday';
        $params = array('matchday' => $matchday);
        $userTypes = $this->getEntityManager()->getConnection()->executeQuery($sql, $params)->fetchAll();

        return $userTypes;
    }

    // /**
    //  * @return Type[] Returns an array of Type objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Type
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
