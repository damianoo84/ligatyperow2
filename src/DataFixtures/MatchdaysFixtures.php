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
                'dateFrom' => '2023-09-11',
                'dateTo' => '2023-09-17',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2023-09-18',
                'dateTo' => '2023-09-24',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2023-09-25',
                'dateTo' => '2023-10-01',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2023-10-02',
                'dateTo' => '2023-10-08',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2023-10-09',
                'dateTo' => '2023-10-15',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2023-10-16',
                'dateTo' => '2023-10-22',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2023-10-23',
                'dateTo' => '2023-10-29',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2023-10-30',
                'dateTo' => '2023-11-05',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2023-11-06',
                'dateTo' => '2023-11-12',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2023-11-13',
                'dateTo' => '2023-11-19',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2023-11-20',
                'dateTo' => '2023-11-26',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2023-11-27',
                'dateTo' => '2023-12-03',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2023-12-04',
                'dateTo' => '2023-12-10',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2023-12-11',
                'dateTo' => '2023-12-17',
                'season_name' => 'Jesień 2023'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2023-12-18',
                'dateTo' => '2023-12-24',
                'season_name' => 'Jesień 2023'
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
