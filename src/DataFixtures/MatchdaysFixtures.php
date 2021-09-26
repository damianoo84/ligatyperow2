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
                'dateFrom' => '2021-09-27',
                'dateTo' => '2021-09-28',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2021-09-29',
                'dateTo' => '2021-09-30',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2021-10-01',
                'dateTo' => '2021-10-03',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2021-10-04',
                'dateTo' => '2021-10-10',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2021-10-11',
                'dateTo' => '2021-10-17',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2021-10-18',
                'dateTo' => '2021-10-24',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2021-10-25',
                'dateTo' => '2021-10-31',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2021-11-01',
                'dateTo' => '2021-11-07',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2021-11-08',
                'dateTo' => '2021-11-14',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2021-11-15',
                'dateTo' => '2021-11-21',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2021-11-22',
                'dateTo' => '2021-11-28',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2021-11-29',
                'dateTo' => '2021-12-05',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2021-12-06',
                'dateTo' => '2021-12-12',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2021-12-13',
                'dateTo' => '2021-12-19',
                'season_name' => 'Jesień 2021'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2021-12-20',
                'dateTo' => '2021-12-26',
                'season_name' => 'Jesień 2021'
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
