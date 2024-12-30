<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Meet;

class MeetsFixtures extends Fixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager) {

        $meetsList = array(
            array(
                'meet_name' => 'Mecz 01',
                'team_name_1' => 'Leicester City',
                'team_name_2' => 'Arsenal Londyn',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Sobota,15-02-2025,13:30',
                'position' => 1,
            ),
            array(
                'meet_name' => 'Mecz 2',
                'team_name_1' => 'VFB Stuttgart',
                'team_name_2' => 'VFL Wolfsburg',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Niemiecka',
                'term' => 'Sobota,15-02-2025,15:30',
                'position' => 2,
            ),
            array(
                'meet_name' => 'Mecz 3',
                'team_name_1' => 'Bayer 04 Leverkusen',
                'team_name_2' => 'Bayern Monachium',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Niemiecka',
                'term' => 'Sobota,15-02-2025,18:30',
                'position' => 3,
            ),
            array(
                'meet_name' => 'Mecz 4',
                'team_name_1' => 'Manchester City',
                'team_name_2' => 'Newcastle United',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Sobota,15-02-2025,16:00',
                'position' => 4,
            ),
            array(
                'meet_name' => 'Mecz 5',
                'team_name_1' => 'Juventus Turyn',
                'team_name_2' => 'Inter Mediolan',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Niedziela,16-02-2025,15:00',
                'position' => 5,
            ),
            array(
                'meet_name' => 'Mecz 6',
                'team_name_1' => 'Lazio Rzym',
                'team_name_2' => 'SSC Napoli',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Niedziela,16-02-2025,16:00',
                'position' => 6,
            ),
            array(
                'meet_name' => 'Mecz 7',
                'team_name_1' => 'AC Parma',
                'team_name_2' => 'AS Roma',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Niedziela,16-02-2025,15:00',
                'position' => 7,
            ),
            array(
                'meet_name' => 'Mecz 8',
                'team_name_1' => 'Tottenham Londyn',
                'team_name_2' => 'Manchester United',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Niedziela,16-02-2025,17:30',
                'position' => 8,
            ),
            array(
                'meet_name' => 'Mecz 9',
                'team_name_1' => 'Betis Sevilla',
                'team_name_2' => 'Real Sociedad',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Niedziela,16-02-2025,18:00',
                'position' => 9,
            ),
            array(
                'meet_name' => 'Mecz 10',
                'team_name_1' => 'Villarreal CF',
                'team_name_2' => 'Valencia CF',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Niedziela,16-02-2025,18:00',
                'position' => 10,
            )

        );
        
        $counter = 1;
        $matchdays = 15;
        
//        for($i=1;$i<=$matchdays;$i++){
            foreach ($meetsList as $meetsDetails) {

                $meet = new Meet();
                $meet->setPosition($meetsDetails['position']);
                $meet->setTerm($meetsDetails['term']);
                $meet->setMatchday($this->getReference('matchday-'.$meetsDetails['matchday_name']));
                $meet->setHostTeam($this->getReference('team-'.$meetsDetails['team_name_1']));
                $meet->setGuestTeam($this->getReference('team-'.$meetsDetails['team_name_2']));
                $meet->setName('Mecz '.$counter);
                $meet->setLeague($this->getReference('League-'.$meetsDetails['description']));

                $this->addReference('meet-Mecz '.$counter, $meet);
//                var_dump($counter);
                $manager->persist($meet);
                $counter++;
            }
//        }

            $manager->flush();
        
    }
    
}