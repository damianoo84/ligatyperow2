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
                'team_name_1' => 'Tottenham Londyn',
                'team_name_2' => 'Arsenal Londyn',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Niedziela,15-09-2024,15:00',
                'position' => 1,
            ),
            array(
                'meet_name' => 'Mecz 2',
                'team_name_1' => 'Aston Villa Birmingham',
                'team_name_2' => 'Everton FC',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Sobota,14-09-2024,18:30',
                'position' => 2,
            ),
            array(
                'meet_name' => 'Mecz 3',
                'team_name_1' => 'Girona FC',
                'team_name_2' => 'FC Barcelona',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Sobota,15-09-2024,18:45',
                'position' => 3,
            ),
            array(
                'meet_name' => 'Mecz 4',
                'team_name_1' => 'Atletico Madryt',
                'team_name_2' => 'Valencia CF',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Sobota,15-09-2024,18:45',
                'position' => 4,
            ),
            array(
                'meet_name' => 'Mecz 5',
                'team_name_1' => 'Real Sociedad',
                'team_name_2' => 'Real Madryt',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Sobota,15-09-2024,18:45',
                'position' => 5,
            ),
            array(
                'meet_name' => 'Mecz 6',
                'team_name_1' => 'Atalanta Bergamo',
                'team_name_2' => 'Fiorentina',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Sobota,15-09-2024,16:00',
                'position' => 6,
            ),
            array(
                'meet_name' => 'Mecz 7',
                'team_name_1' => 'AC Parma',
                'team_name_2' => 'Udinese Calcio',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Niedziela,15-09-2024,15:30',
                'position' => 7,
            ),
            array(
                'meet_name' => 'Mecz 8',
                'team_name_1' => 'RC Lens',
                'team_name_2' => 'Olympique Lyon',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Francuska',
                'term' => 'Niedziela,15-09-2024,20:00',
                'position' => 8,
            ),
            array(
                'meet_name' => 'Mecz 9',
                'team_name_1' => 'Olympique Marsylia',
                'team_name_2' => 'OGC Nice',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Francuska',
                'term' => 'Niedziela,15-09-2024,20:00',
                'position' => 9,
            ),
            array(
                'meet_name' => 'Mecz 10',
                'team_name_1' => 'AJ Auxerre',
                'team_name_2' => 'AS Monaco',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Francuska',
                'term' => 'Niedziela,15-09-2024,20:00',
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