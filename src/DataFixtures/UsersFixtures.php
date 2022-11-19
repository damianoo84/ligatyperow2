<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\User;

class UsersFixtures extends Fixture implements OrderedFixtureInterface {
    
    /**
     *
     * @var ContainerInterface
     */
    private $container;

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getOrder() {
        return 0;
    }
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        
        $usersList = array(
            array(
                'username' => 'Damian',
                'shortname' => 'D',
                'email' => 'test1@test.pl',
                'password' => 'DDAAMM',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 1,
                'phone' => '606119978',
                'role' => 'ROLE_SUPER_ADMIN',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Damian',
                'favoritepolandteam' => 'GKS Katowice',
                'favoriteforeignteam' => 'FC Barcelona',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 3                 
            ),
            array(
                'username' => 'Wojtek',
                'shortname' => 'W',
                'email' => 'test2@test.pl',
                'password' => '$2a$12$RqwQmBxfZxJGnXWGc4G57uLL8.qTl1gyAX9mw1kg4P.ekEKOqwGyW',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 2,
                'phone' => '887033022',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Wojtek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 2,
                'numberofthirdplaces' => 2    
            ),
            array(
                'username' => 'Mateusz',
                'shortname' => 'MT',
                'email' => 'test3@test.pl',
                'password' => '$2a$12$RqwQmBxfZxJGnXWGc4G57uLL8.qTl1gyAX9mw1kg4P.ekEKOqwGyW',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 3,
                'phone' => '730310189',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Mateusz',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 3     
            ),
            array(
                'username' => 'Marcin1',
                'shortname' => 'M',
                'email' => 'test4@test.pl',
                'password' => 'psw326',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 4,
                'phone' => '881737984',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Marcin1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 1     
            ),
            array(
                'username' => 'Krystian',
                'shortname' => 'K',
                'email' => 'test5@test.pl',
                'password' => 'psw874',
                'numberofwins' => 1,
                'status' => 1,
                'priority' => 5,
                'phone' => '796818505',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Krystian',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 2,
                'numberofthirdplaces' => 3    
            ),
            array(
                'username' => 'Piotrek1',
                'shortname' => 'P1',
                'email' => 'test6@test.pl',
                'password' => 'psw905',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 6,
                'phone' => '508294223',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Piotrek1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 4,
                'numberofthirdplaces' => 4    
            ),
            array(
                'username' => 'Tomek',
                'shortname' => 'T',
                'email' => 'test7@test.pl',
                'password' => 'psw554',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 7,
                'phone' => '666666666',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Tomek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 1,
                'numberofthirdplaces' => 0      
            ),
            array(
                'username' => 'Michał',
                'shortname' => 'MŁ',
                'email' => 'test8@test.pl',
                'password' => 'njkassd',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 8,
                'phone' => '777777777',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Michał',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 1    
            ),
            array(
                'username' => 'Adam1',
                'shortname' => 'A1',
                'email' => 'test9@test.pl',
                'password' => 'mdkslmdas',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 9,
                'phone' => '888888888',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Adam1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 1,
                'numberofthirdplaces' => 0     
            ),
            array(
                'username' => 'Przemek1',
                'shortname' => 'PM1',
                'email' => 'test10@test.pl',
                'password' => 'c7z3',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 10,
                'phone' => '999999999',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Przemek1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0   
            ),
            array(
                'username' => 'Łukasz1',
                'shortname' => 'Ł',
                'email' => 'test11@test.pl',
                'password' => 'hduahsd',
                'numberofwins' => 1,
                'status' => 0,
                'priority' => 11,
                'phone' => '111111112',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Łukasz1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Piotrek2',
                'shortname' => 'P2',
                'email' => 'test12@test.pl',
                'password' => 'uyieyrewr',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 12,
                'phone' => '222222223',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Piotrek2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Kuba1',
                'shortname' => 'KB',
                'email' => 'test13@test.pl',
                'password' => 'psw546',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 13,
                'phone' => '514649985',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Kuba1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Przemek2',
                'shortname' => 'PM2',
                'email' => 'test14@test.pl',
                'password' => 'psw214',
                'numberofwins' => 2,
                'status' => 1,
                'priority' => 14,
                'phone' => '517496559',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Przemek2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 2,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 0   
            ),
            array(
                'username' => 'Adam2',
                'shortname' => 'A2',
                'email' => 'test15@test.pl',
                'password' => 'ncknddas',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 15,
                'phone' => '555555556',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Adam2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Piotrek3',
                'shortname' => 'P3',
                'email' => 'test16@test.pl',
                'password' => 'psw219',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 16,
                'phone' => '509011637',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Piotrek3',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 4,
                'numberofthirdplaces' => 3   
            ),
            array(
                'username' => 'Arek',
                'shortname' => 'AR',
                'email' => 'test17@test.pl',
                'password' => 'psw572',
                'numberofwins' => 2,
                'status' => 1,
                'priority' => 17,
                'phone' => '692075286',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Arek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 2,
                'numberofsecondplaces' => 2,
                'numberofthirdplaces' => 3   
            ),
            array(
                'username' => 'Zbyszek',
                'shortname' => 'ZB',
                'email' => 'test18@test.pl',
                'password' => 'psw465',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 18,
                'phone' => '609414775',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Zbyszek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Robert',
                'shortname' => 'RO',
                'email' => 'test19@test.pl',
                'password' => 'psw843',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 19,
                'phone' => '501167408',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Robert',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Adrian',
                'shortname' => 'AD',
                'email' => 'test20@test.pl',
                'password' => 'cd333',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 20,
                'phone' => '604115331',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Adrian',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Kamil',
                'shortname' => 'KA',
                'email' => 'test21@test.pl',
                'password' => 'fgdgfgd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 21,
                'phone' => '537844037',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Kamil',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 1,
                'numberofthirdplaces' => 0   
            ),
            array(
                'username' => 'Kuba2',
                'shortname' => 'K2',
                'email' => 'test22@test.pl',
                'password' => 'fgdgfgd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 22,
                'phone' => '501652282',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Kuba2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0   
            ),
            array(
                'username' => 'Piotrek4',
                'shortname' => 'P4',
                'email' => 'test23test.pl',
                'password' => 'fgdgfgd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 23,
                'phone' => '508438311',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Piotrek4',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0  
            ),
            array(
                'username' => 'Łukasz2',
                'shortname' => 'Ł2',
                'email' => 'test24test.pl',
                'password' => 'fgdgfsssagd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 24,
                'phone' => '607173821',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Łukasz2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0      
            ),
            array(
                'username' => 'Marcin2',
                'shortname' => 'M2',
                'email' => 'test25test.pl',
                'password' => 'fgdgfsssasagd',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 25,
                'phone' => '502903704',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Marcin2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0    
            ),
            array(
                'username' => 'Grzegorz',
                'shortname' => 'GR',
                'email' => 'test26test.pl',
                'password' => 'fgdgwwagd',
                'numberofwins' => 1,
                'status' => 1,
                'priority' => 26,
                'phone' => '573266025',
                'role' => 'ROLE_USER',
                'rankingposition' => 1,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Grzegorz',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0    
            )

        );

        foreach ($usersList as $userDetails) {
            $user = new User();

            $password = $this->passwordEncoder->encodePassword($user, $userDetails['password']);
            $user->setUsername($userDetails['username']);
            $user->setShortname($userDetails['shortname']);
            $user->setEmail($userDetails['email']);
            $user->setPassword("sss");
            $user->setPassword($password);
            $user->setRoles(array($userDetails['role']));
            $user->setPriority($userDetails['priority']);
            $user->setStatus($userDetails['status']);
            $user->setNumberofwins($userDetails['numberofwins']);
            $user->setPhone($userDetails['phone']);
            $user->setRankingPosition($userDetails['rankingposition']);
            $user->setMinPointsPerQueue($userDetails['minpointsperqueue']);
            $user->setMaxPointsPerQueue($userDetails['maxpointsperqueue']);
            $user->setNick($userDetails['nick']);
            $user->setFavoritePolandTeam($userDetails['favoritepolandteam']);
            $user->getFavoriteForeignTeam($userDetails['favoriteforeignteam']);
            $user->setNumberOfFirstPlaces($userDetails['numberoffirstplaces']);
            $user->setNumberOfSecondPlaces($userDetails['numberofsecondplaces']);
            $user->setNumberOfThirdPlaces($userDetails['numberofthirdplaces']);
            
            $this->addReference('user-'.$userDetails['nick'], $user);
            
            $manager->persist($user);
        }
        
        $manager->flush();
        
    }

}