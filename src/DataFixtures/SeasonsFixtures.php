<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Season;

class SeasonsFixtures extends Fixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 0;
    }

    public function load(ObjectManager $manager) {
        
        $seasonsList = array(
            array(
                'season_name' => 'Jesień 2011',
                'dateStart' => '2011-09-01',
                'dateEnd' => '2011-12-16',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2012',
                'dateStart' => '2012-02-01',
                'dateEnd' => '2012-05-16',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2012',
                'dateStart' => '2012-09-01',
                'dateEnd' => '2012-12-16',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2013',
                'dateStart' => '2013-02-01',
                'dateEnd' => '2013-05-16',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2013',
                'dateStart' => '2013-09-01',
                'dateEnd' => '2013-12-16',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2014',
                'dateStart' => '2014-02-01',
                'dateEnd' => '2014-05-16',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2014',
                'dateStart' => '2014-09-01',
                'dateEnd' => '2014-12-16',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2015',
                'dateStart' => '2015-02-01',
                'dateEnd' => '2015-05-16',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2015',
                'dateStart' => '2015-09-07',
                'dateEnd' => '2015-12-20',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2016',
                'dateStart' => '2016-02-01',
                'dateEnd' => '2016-05-16',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2016',
                'dateStart' => '2016-09-05',
                'dateEnd' => '2016-12-18',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2017',
                'dateStart' => '2017-02-06',
                'dateEnd' => '2017-05-21',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2017',
                'dateStart' => '2017-09-11',
                'dateEnd' => '2017-12-24',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2018',
                'dateStart' => '2018-02-05',
                'dateEnd' => '2018-05-20',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2018',
                'dateStart' => '2018-09-01',
                'dateEnd' => '2018-12-20',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2019',
                'dateStart' => '2019-02-11',
                'dateEnd' => '2019-05-26',
                'active' => true
            ),
            array(
                'season_name' => 'Jesień 2019',
                'dateStart' => '2019-09-02',
                'dateEnd' => '2019-12-22',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2020',
                'dateStart' => '2020-02-10',
                'dateEnd' => '2020-05-24',
                'active' => false
            ),
            array(
                'season_name' => 'Jesień 2020',
                'dateStart' => '2020-09-07',
                'dateEnd' => '2020-12-20',
                'active' => false
            ),
            array(
                'season_name' => 'Wiosna 2021',
                'dateStart' => '2021-02-01',
                'dateEnd' => '2021-05-26',
                'active' => true
            ),
            array(
                'season_name' => 'Jesień 2021',
                'dateStart' => '2021-09-13',
                'dateEnd' => '2021-12-26',
                'active' => true
            ),
            array(
                'season_name' => 'Wiosna 2022',
                'dateStart' => '2022-02-07',
                'dateEnd' => '2022-05-22',
                'active' => true
            ),
            array(
                'season_name' => 'Jesień 2022',
                'dateStart' => '2022-08-01',
                'dateEnd' => '2022-11-20',
                'active' => true
            ),
            array(
                'season_name' => 'Wiosna 2023',
                'dateStart' => '2023-02-13',
                'dateEnd' => '2023-06-04',
                'active' => true
            ),
            array(
                'season_name' => 'Jesień 2023',
                'dateStart' => '2023-09-11',
                'dateEnd' => '2023-12-24',
                'active' => true
            ),
			array(
                'season_name' => 'Wiosna 2024',
                'dateStart' => '2024-02-12',
                'dateEnd' => '2024-05-26',
                'active' => true
            )
        );
        
        foreach ($seasonsList as $seasonsDetails) {
            $season = new Season();
            $season->setName($seasonsDetails['season_name']);
            $season->setDateStart(new \DateTime($seasonsDetails['dateStart']));
            $season->setDateEnd(new \DateTime($seasonsDetails['dateEnd']));
            $season->setIsActive($seasonsDetails['active']);
                    
            $this->addReference('season-'.$seasonsDetails['season_name'], $season);
            
            $manager->persist($season);
        }
        
        $manager->flush();
        
    }
    
}