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
                'nick' => 'Damian',
                'shortname' => 'D',
                'email' => 'test1@test.pl',
                'password' => 'DDAAMM',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 1,
                'phone' => '606119978',
                'role' => 'ROLE_SUPER_ADMIN'
            ),
            array(
                'nick' => 'Wojtek',
                'shortname' => 'W',
                'email' => 'test2@test.pl',
                'password' => '$2a$12$RqwQmBxfZxJGnXWGc4G57uLL8.qTl1gyAX9mw1kg4P.ekEKOqwGyW',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 2,
                'phone' => '887033022',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Mateusz',
                'shortname' => 'MT',
                'email' => 'test3@test.pl',
                'password' => '$2a$12$RqwQmBxfZxJGnXWGc4G57uLL8.qTl1gyAX9mw1kg4P.ekEKOqwGyW',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 3,
                'phone' => '730310189',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Marcin1',
                'shortname' => 'M',
                'email' => 'test4@test.pl',
                'password' => 'psw326',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 4,
                'phone' => '881737984',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Krystian',
                'shortname' => 'K',
                'email' => 'test5@test.pl',
                'password' => 'psw874',
                'numberofwins' => 1,
                'status' => 1,
                'priority' => 5,
                'phone' => '796818505',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Piotrek1',
                'shortname' => 'P1',
                'email' => 'test6@test.pl',
                'password' => 'psw905',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 6,
                'phone' => '508294223',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Tomek',
                'shortname' => 'T',
                'email' => 'test7@test.pl',
                'password' => 'psw554',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 7,
                'phone' => '666666666',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Michał',
                'shortname' => 'MŁ',
                'email' => 'test8@test.pl',
                'password' => 'njkassd',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 8,
                'phone' => '777777777',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Adam1',
                'shortname' => 'A1',
                'email' => 'test9@test.pl',
                'password' => 'mdkslmdas',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 9,
                'phone' => '888888888',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Przemek1',
                'shortname' => 'PM1',
                'email' => 'test10@test.pl',
                'password' => 'c7z3',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 10,
                'phone' => '999999999',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Łukasz1',
                'shortname' => 'Ł',
                'email' => 'test11@test.pl',
                'password' => 'hduahsd',
                'numberofwins' => 1,
                'status' => 0,
                'priority' => 11,
                'phone' => '111111112',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Piotrek2',
                'shortname' => 'P2',
                'email' => 'test12@test.pl',
                'password' => 'uyieyrewr',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 12,
                'phone' => '222222223',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Kuba1',
                'shortname' => 'KB',
                'email' => 'test13@test.pl',
                'password' => 'psw546',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 13,
                'phone' => '514649985',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Przemek2',
                'shortname' => 'PM2',
                'email' => 'test14@test.pl',
                'password' => 'psw214',
                'numberofwins' => 2,
                'status' => 1,
                'priority' => 14,
                'phone' => '517496559',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Adam2',
                'shortname' => 'A2',
                'email' => 'test15@test.pl',
                'password' => 'ncknddas',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 15,
                'phone' => '555555556',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Piotrek3',
                'shortname' => 'P3',
                'email' => 'test16@test.pl',
                'password' => 'psw219',
                'numberofwins' => 2,
                'status' => 1,
                'priority' => 16,
                'phone' => '509011637',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Arek',
                'shortname' => 'AR',
                'email' => 'test17@test.pl',
                'password' => 'psw572',
                'numberofwins' => 2,
                'status' => 1,
                'priority' => 17,
                'phone' => '692075286',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Zbyszek',
                'shortname' => 'ZB',
                'email' => 'test18@test.pl',
                'password' => 'psw465',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 18,
                'phone' => '609414775',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Robert',
                'shortname' => 'RO',
                'email' => 'test19@test.pl',
                'password' => 'psw843',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 19,
                'phone' => '501167408',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Adrian',
                'shortname' => 'AD',
                'email' => 'test20@test.pl',
                'password' => 'cd333',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 20,
                'phone' => '604115331',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Kamil',
                'shortname' => 'KA',
                'email' => 'test21@test.pl',
                'password' => 'fgdgfgd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 21,
                'phone' => '537844037',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Kuba2',
                'shortname' => 'K2',
                'email' => 'test22@test.pl',
                'password' => 'fgdgfgd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 22,
                'phone' => '501652282',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Piotrek4',
                'shortname' => 'P4',
                'email' => 'test23test.pl',
                'password' => 'fgdgfgd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 23,
                'phone' => '508438311',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Łukasz2',
                'shortname' => 'Ł2',
                'email' => 'test24test.pl',
                'password' => 'fgdgfsssagd',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 24,
                'phone' => '607173821',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Marcin2',
                'shortname' => 'M2',
                'email' => 'test25test.pl',
                'password' => 'fgdgfsssasagd',
                'numberofwins' => 0,
                'status' => 0,
                'priority' => 25,
                'phone' => '502903704',
                'role' => 'ROLE_USER'
            ),
            array(
                'nick' => 'Grzegorz',
                'shortname' => 'GR',
                'email' => 'test26test.pl',
                'password' => 'fgdgwwagd',
                'numberofwins' => 1,
                'status' => 1,
                'priority' => 26,
                'phone' => '573266025',
                'role' => 'ROLE_USER'
            )

        );

        foreach ($usersList as $userDetails) {
            $user = new User();

            $password = $this->passwordEncoder->encodePassword($user, $userDetails['password']);
            $user->setUsername($userDetails['nick']);
            $user->setShortname($userDetails['shortname']);
            $user->setEmail($userDetails['email']);
            $user->setPassword("sss");
            $user->setPassword($password);
            $user->setRoles(array($userDetails['role']));
            $user->setPriority($userDetails['priority']);
            $user->setStatus($userDetails['status']);
            $user->setNumberofwins($userDetails['numberofwins']);
            $user->setPhone($userDetails['phone']);
            $user->setRankingPosition(1);
            $user->setMinPointsPerQueue(12);
            $user->setMaxPointsPerQueue(12);

            $this->addReference('user-'.$userDetails['nick'], $user);
            
            $manager->persist($user);
            
        }
        
        $manager->flush();
        
    }

}