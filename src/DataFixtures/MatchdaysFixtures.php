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
                'dateFrom' => '2025-02-10',
                'dateTo' => '2025-02-16',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2025-02-17',
                'dateTo' => '2025-02-23',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2025-02-24',
                'dateTo' => '2025-03-02',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2025-03-03',
                'dateTo' => '2025-03-09',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2025-03-10',
                'dateTo' => '2025-03-16',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2025-03-17',
                'dateTo' => '2025-03-23',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2025-03-24',
                'dateTo' => '2025-03-30',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2025-03-31',
                'dateTo' => '2025-04-06',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2025-04-07',
                'dateTo' => '2025-04-13',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2025-04-14',
                'dateTo' => '2025-04-20',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2025-04-21',
                'dateTo' => '2025-04-27',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2025-04-28',
                'dateTo' => '2025-05-04',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2025-05-05',
                'dateTo' => '2025-05-11',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2025-05-12',
                'dateTo' => '2025-05-18',
                'season_name' => 'Wiosna 2025'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2025-05-19',
                'dateTo' => '2025-05-25',
                'season_name' => 'Wiosna 2025'
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
