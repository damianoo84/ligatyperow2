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
                'dateFrom' => '2021-06-27',
                'dateTo' => '2021-06-29',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2021-07-30',
                'dateTo' => '2021-07-08',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2021-07-09',
                'dateTo' => '2021-07-12',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2021-07-13',
                'dateTo' => '2021-07-16',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2021-07-17',
                'dateTo' => '2021-07-19',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2021-07-20',
                'dateTo' => '2021-07-22',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2021-07-23',
                'dateTo' => '2021-07-25',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2021-07-26',
                'dateTo' => '2021-07-28',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2021-07-29',
                'dateTo' => '2021-07-31',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2021-08-01',
                'dateTo' => '2021-08-03',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2021-08-04',
                'dateTo' => '2021-08-06',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2021-07-07',
                'dateTo' => '2021-07-09',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2021-07-10',
                'dateTo' => '2021-07-12',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2021-08-13',
                'dateTo' => '2021-08-15',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2021-08-16',
                'dateTo' => '2021-08-18',
                'season_name' => 'Wiosna 2021'
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
