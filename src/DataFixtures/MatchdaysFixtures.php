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
                'dateFrom' => '2021-05-24',
                'dateTo' => '2021-05-26',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2021-05-27',
                'dateTo' => '2021-05-29',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2021-05-30',
                'dateTo' => '2021-06-01',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2021-06-02',
                'dateTo' => '2021-06-04',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2021-06-03',
                'dateTo' => '2021-06-05',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2021-03-15',
                'dateTo' => '2021-03-21',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2021-03-22',
                'dateTo' => '2021-03-28',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2021-03-29',
                'dateTo' => '2021-04-04',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2021-04-05',
                'dateTo' => '2021-04-11',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2021-04-12',
                'dateTo' => '2021-04-18',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2021-04-19',
                'dateTo' => '2021-04-25',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2021-04-26',
                'dateTo' => '2021-05-02',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2021-05-03',
                'dateTo' => '2021-05-09',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2021-05-10',
                'dateTo' => '2021-05-16',
                'season_name' => 'Wiosna 2021'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2021-05-17',
                'dateTo' => '2021-05-23',
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
