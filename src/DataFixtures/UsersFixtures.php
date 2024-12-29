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
                'password' => '$2y$13$lE0vZclvRWv/YYkcOgJkQusuCctO0s44l8m5SVZJMuA43p4bzDedi',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 1,
                'phone' => '606119978',
                'role' => 'ROLE_SUPER_ADMIN',
                'rankingposition' => 13,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Damian',
                'favoritepolandteam' => 'GKS Katowice',
                'favoriteforeignteam' => 'FC Barcelona',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 3, 
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Wojtek',
                'shortname' => 'W',
                'email' => 'test2@test.pl',
                'password' => '$2a$12$XOtOBiqtk/e5Q9ePpsQ/8OlruaHByX8vm1SQLVrkcuVwdGRk/6/6.',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 2,
                'phone' => '887033022',
                'role' => 'ROLE_USER',
                'rankingposition' => 5,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Wojtek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 2,
                'numberofthirdplaces' => 2,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Mateusz',
                'shortname' => 'MT',
                'email' => 'test3@test.pl',
                'password' => '$2a$12$PdukZFqxQXhR7FcpNQKRnOnb71cZlzNCd7mZ9VFWqwBooP.Tp9uYe',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 3,
                'phone' => '730310189',
                'role' => 'ROLE_USER',
                'rankingposition' => 19,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Mateusz',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 3,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Marcin1',
                'shortname' => 'M',
                'email' => 'test4@test.pl',
                'password' => '$2y$13$mydlkZRIkoC9Kqd.R7iufeD78gvO/7KRl4QlwF.6jzQhu5.c8OK1a',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 4,
                'phone' => '881737984',
                'role' => 'ROLE_USER',
                'rankingposition' => 6,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Marcin1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 1,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Krystian',
                'shortname' => 'K',
                'email' => 'test5@test.pl',
                'password' => '$2a$12$WbEAzwh4hkv8W8GwTFIaFO1DLO27Sj7NSVC7zEY0k.5/YMqzU2YYi',
                'numberofwins' => 1,
                'status' => 1,
                'priority' => 5,
                'phone' => '796818505',
                'role' => 'ROLE_USER',
                'rankingposition' => 9,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Krystian',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 2,
                'numberofthirdplaces' => 3,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Piotrek1',
                'shortname' => 'P1',
                'email' => 'test6@test.pl',
                'password' => '$2y$13$N37jhru8GK9B1UJg/xCinOV04CRiDDWOjRJevx4y2EQrGy/.L3AfS',
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
                'numberofthirdplaces' => 4,
                'lastWinner' => 0,
                'liderOfRanking' => 1
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
                'rankingposition' => 15,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Tomek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 1,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
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
                'rankingposition' => 20,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Michał',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 1,
                'lastWinner' => 0,
                'liderOfRanking' => 0
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
                'rankingposition' => 17,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Adam1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 1,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
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
                'rankingposition' => 24,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Przemek1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
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
                'rankingposition' => 8,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Łukasz1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
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
                'rankingposition' => 22,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Piotrek2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Kuba1',
                'shortname' => 'KB',
                'email' => 'test13@test.pl',
                'password' => '$2a$12$moDfDnkZC1PovnFofUW.V.ZpYbaoGlK.PrVnBvflLKr.2dvD1cFYu',
                'numberofwins' => 3,
                'status' => 1,
                'priority' => 13,
                'phone' => '514649985',
                'role' => 'ROLE_USER',
                'rankingposition' => 3,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Kuba1',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Przemek2',
                'shortname' => 'PM2',
                'email' => 'test14@test.pl',
                'password' => '$2a$12$7g53gQVmLyp4s2HBM61KuOs9NJpQSEaYY3aXrTsv4/FbvbjU3ggjG',
                'numberofwins' => 2,
                'status' => 1,
                'priority' => 14,
                'phone' => '517496559',
                'role' => 'ROLE_USER',
                'rankingposition' => 7,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Przemek2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 2,
                'numberofsecondplaces' => 3,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
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
                'rankingposition' => 23,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Adam2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Piotrek3',
                'shortname' => 'P3',
                'email' => 'test16@test.pl',
                'password' => '$2y$13$CKzC8EX6uHfa18Z6NJdJNuYM5cfAaf8wmLIIGeG73iYmjdQ3tzi.W',
                'numberofwins' => 4,
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
                'numberoffirstplaces' => 4,
                'numberofsecondplaces' => 5,
                'numberofthirdplaces' => 3,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Arek',
                'shortname' => 'AR',
                'email' => 'test17@test.pl',
                'password' => '$2y$13$gS1joItmYrB17YXmQR5rA.avjt6XOiYaI1uFsKFqxwBoC04dFL5Q.',
                'numberofwins' => 2,
                'status' => 1,
                'priority' => 17,
                'phone' => '692075286',
                'role' => 'ROLE_USER',
                'rankingposition' => 4,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Arek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 3,
                'numberofsecondplaces' => 2,
                'numberofthirdplaces' => 3,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Zbyszek',
                'shortname' => 'ZB',
                'email' => 'test18@test.pl',
                'password' => '$2y$13$BkTr82bPPyltXQRegp0oa.W.ZvBntyG6gQ3.XX5jtjpzRvEhBbeN.',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 18,
                'phone' => '609414775',
                'role' => 'ROLE_USER',
                'rankingposition' => 10,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Zbyszek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 1,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Robert',
                'shortname' => 'RO',
                'email' => 'test19@test.pl',
                'password' => '$2a$12$k/kZPMyC.csT1sU/Ghkse.nP6aBevVlE32g18uO3HxCMikC9/oinm',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 19,
                'phone' => '501167408',
                'role' => 'ROLE_USER',
                'rankingposition' => 14,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Robert',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 1,
                'numberofthirdplaces' => 1,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Adrian',
                'shortname' => 'AD',
                'email' => 'test20@test.pl',
                'password' => '$2a$12$/AkLj.HAflC4pcL1scUj2e5hl4g5zfOL4eglhkZ5xd9L45V3BuvvK',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 20,
                'phone' => '604115331',
                'role' => 'ROLE_USER',
                'rankingposition' => 23,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Adrian',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Kamil',
                'shortname' => 'KA',
                'email' => 'test21@test.pl',
                'password' => '$2a$12$APK77TpUy1usrpFgH3a7g.SqNIBaEtvIm4XoPA1YCTjPi37D/85.6',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 21,
                'phone' => '537844037',
                'role' => 'ROLE_USER',
                'rankingposition' => 18,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Kamil',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 1,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Kuba2',
                'shortname' => 'K2',
                'email' => 'test22@test.pl',
                'password' => '$2a$12$9RC034P6yZEsplIyBIFj4ubyVqhVDZFGhQ0u3/UB/4TTVUhE8ui6e',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 22,
                'phone' => '501652282',
                'role' => 'ROLE_USER',
                'rankingposition' => 21,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Kuba2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Piotrek4',
                'shortname' => 'P4',
                'email' => 'test23test.pl',
                'password' => '$2y$13$G8FSaVmuJe22i27UdgOf..gyEYkK4dxooEdVwpdjj0wLg3lTP7kiu',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 23,
                'phone' => '508438311',
                'role' => 'ROLE_USER',
                'rankingposition' => 11,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Piotrek4',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Łukasz2',
                'shortname' => 'Ł2',
                'email' => 'test24test.pl',
                'password' => '$2a$12$2FYHF8zEwFmiZDopw03kEOjJeG2TYP82z0aTt3UFji5yNyGKgk3SG',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 24,
                'phone' => '607173821',
                'role' => 'ROLE_USER',
                'rankingposition' => 16,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Łukasz2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 1,
                'liderOfRanking' => 0
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
                'rankingposition' => 26,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Marcin2',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Grzegorz',
                'shortname' => 'GR',
                'email' => 'test26test.pl',
                'password' => '$2a$12$93as0AAYjmXPBLEN1sFyJ.9FrW8sl4y/jBILhk2uxURRlgfyvWSmS',
                'numberofwins' => 1,
                'status' => 1,
                'priority' => 26,
                'phone' => '573266025',
                'role' => 'ROLE_USER',
                'rankingposition' => 12,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Grzegorz',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 1,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            ),
            array(
                'username' => 'Bartek',
                'shortname' => 'BR',
                'email' => 'test27test.pl',
                'password' => '$2a$12$X28920AMUvH0XhwqTLNNHukbpanOC7Tp2W3K1Mei4.I31Se8a0jN6',
                'numberofwins' => 0,
                'status' => 1,
                'priority' => 27,
                'phone' => '573266028',
                'role' => 'ROLE_USER',
                'rankingposition' => 27,
                'minpointsperqueue' => 0,
                'maxpointsperqueue' => 28,
                'nick' => 'Bartek',
                'favoritepolandteam' => 'myteam',
                'favoriteforeignteam' => 'myteam',
                'numberoffirstplaces' => 0,
                'numberofsecondplaces' => 0,
                'numberofthirdplaces' => 0,
                'lastWinner' => 0,
                'liderOfRanking' => 0
            )

        );

        foreach ($usersList as $userDetails) {
            $user = new User();

//            $password = $this->passwordEncoder->encodePassword($user, $userDetails['password']);
            $user->setUsername($userDetails['username']);
            $user->setShortname($userDetails['shortname']);
            $user->setEmail($userDetails['email']);
            $user->setPassword($userDetails['password']);
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
            $user->setLastWinner($userDetails['lastWinner']);
            $user->setLiderOfRanking($userDetails['liderOfRanking']);
            
            $this->addReference('user-'.$userDetails['nick'], $user);
            
            $manager->persist($user);
        }
        
        $manager->flush();
        
    }

}