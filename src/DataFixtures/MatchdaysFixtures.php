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
                'dateFrom' => '2023-02-13',
                'dateTo' => '2023-02-19',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2023-02-20',
                'dateTo' => '2023-02-26',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2023-02-27',
                'dateTo' => '2023-03-05',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2023-03-06',
                'dateTo' => '2023-03-12',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2023-03-13',
                'dateTo' => '2023-03-19',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2023-03-20',
                'dateTo' => '2023-03-26',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2023-03-27',
                'dateTo' => '2023-04-02',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2023-04-03',
                'dateTo' => '2023-04-09',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2023-04-10',
                'dateTo' => '2023-04-16',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2023-04-17',
                'dateTo' => '2023-04-23',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2023-04-24',
                'dateTo' => '2023-04-30',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2023-05-01',
                'dateTo' => '2023-05-07',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2023-05-08',
                'dateTo' => '2023-05-14',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2023-05-15',
                'dateTo' => '2023-05-21',
                'season_name' => 'Wiosna 2023'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2023-05-22',
                'dateTo' => '2023-05-28',
                'season_name' => 'Wiosna 2023'
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
