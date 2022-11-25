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
                'dateFrom' => '2022-11-27',
                'dateTo' => '2022-11-29',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2022-11-30',
                'dateTo' => '2022-12-01',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2022-12-15',
                'dateTo' => '2022-12-21',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2022-12-22',
                'dateTo' => '2022-12-28',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2023-08-29',
                'dateTo' => '2023-09-04',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2023-09-05',
                'dateTo' => '2023-09-11',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2023-09-12',
                'dateTo' => '2023-09-18',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2023-09-19',
                'dateTo' => '2023-09-25',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2023-09-26',
                'dateTo' => '2023-10-02',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2023-10-03',
                'dateTo' => '2023-10-09',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2023-10-10',
                'dateTo' => '2023-10-16',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2023-10-17',
                'dateTo' => '2023-10-23',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2023-10-24',
                'dateTo' => '2023-10-30',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2023-10-31',
                'dateTo' => '2023-11-06',
                'season_name' => 'Jesień 2022'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2023-11-07',
                'dateTo' => '2023-11-13',
                'season_name' => 'Jesień 2022'
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
