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
                'dateFrom' => '2024-02-12',
                'dateTo' => '2024-02-18',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2024-02-19',
                'dateTo' => '2024-02-25',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2024-02-26',
                'dateTo' => '2024-03-03',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2024-03-04',
                'dateTo' => '2024-03-10',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2024-03-11',
                'dateTo' => '2024-03-17',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2024-03-18',
                'dateTo' => '2024-03-24',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2024-03-25',
                'dateTo' => '2024-03-31',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2024-04-01',
                'dateTo' => '2024-04-07',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2024-04-08',
                'dateTo' => '2024-04-14',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2024-04-15',
                'dateTo' => '2024-04-21',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2024-04-22',
                'dateTo' => '2024-04-28',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2024-04-29',
                'dateTo' => '2024-05-05',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2024-05-06',
                'dateTo' => '2024-05-12',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2024-05-13',
                'dateTo' => '2024-05-19',
                'season_name' => 'Wiosna 2024'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2024-05-20',
                'dateTo' => '2024-05-26',
                'season_name' => 'Wiosna 2024'
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
