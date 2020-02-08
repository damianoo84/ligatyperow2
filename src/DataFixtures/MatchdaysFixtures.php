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
                'dateFrom' => '2020-02-10',
                'dateTo' => '2020-02-16',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2020-02-17',
                'dateTo' => '2020-02-23',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2020-02-24',
                'dateTo' => '2020-03-01',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2020-03-02',
                'dateTo' => '2020-03-08',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2020-03-09',
                'dateTo' => '2020-03-15',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2020-03-16',
                'dateTo' => '2020-03-22',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2020-03-23',
                'dateTo' => '2020-03-29',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2020-03-30',
                'dateTo' => '2020-04-05',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2020-04-06',
                'dateTo' => '2020-04-12',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2020-04-13',
                'dateTo' => '2020-04-19',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2020-04-20',
                'dateTo' => '2020-04-26',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2020-04-27',
                'dateTo' => '2020-05-03',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2020-05-04',
                'dateTo' => '2020-05-10',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2020-05-11',
                'dateTo' => '2020-05-17',
                'season_name' => 'Wiosna 2020'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2020-05-18',
                'dateTo' => '2020-05-24',
                'season_name' => 'Wiosna 2020'
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
