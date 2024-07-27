<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Matchday;

class MatchdaysFixtures extends Fixture implements OrderedFixtureInterface{
    
    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager) {

        $matchdaysList = array(
            array(
                'matchday_name' => '1',
                'dateFrom' => '2024-09-09',
                'dateTo' => '2024-09-15',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2024-09-16',
                'dateTo' => '2024-09-22',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2024-09-23',
                'dateTo' => '2024-09-29',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2024-09-30',
                'dateTo' => '2024-10-06',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2024-10-07',
                'dateTo' => '2024-10-13',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2024-10-14',
                'dateTo' => '2024-10-20',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2024-10-21',
                'dateTo' => '2024-10-27',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2024-10-28',
                'dateTo' => '2024-11-03',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2024-11-04',
                'dateTo' => '2024-11-10',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2024-11-11',
                'dateTo' => '2024-11-17',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2024-11-18',
                'dateTo' => '2024-11-24',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2024-11-25',
                'dateTo' => '2024-12-01',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2024-12-02',
                'dateTo' => '2024-12-08',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2024-12-09',
                'dateTo' => '2024-12-15',
                'season_name' => 'Jesień 2024'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2024-12-16',
                'dateTo' => '2024-12-22',
                'season_name' => 'Jesień 2024'
            )
        );
        
        foreach ($matchdaysList as $matchdaysDetails) {
            $matchday = new Matchday();
            $matchday->setSeason($this->getReference('season-'.$matchdaysDetails['season_name']));
            $matchday->setName($matchdaysDetails['matchday_name']);
            $matchday->setDateFrom(new \DateTime($matchdaysDetails['dateFrom']));
            $matchday->setDateTo(new \DateTime($matchdaysDetails['dateTo']));
            $this->addReference('matchday-Kolejka '.$matchdaysDetails['matchday_name'], $matchday);
            
            $manager->persist($matchday);
        }
        
        $manager->flush();
        
    }
    
}
