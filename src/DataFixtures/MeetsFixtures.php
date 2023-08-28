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
                'team_name_1' => 'FC Barcelona',
                'team_name_2' => 'Betis Sevilla',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Niedziela,17-09-2023,21:00',
                'position' => 1,
            ),
            array(
                'meet_name' => 'Mecz 2',
                'team_name_1' => 'Real Madryt',
                'team_name_2' => 'Real Sociedad',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Niedziela,17-09-2023,21:00',
                'position' => 2,
            ),
            array(
                'meet_name' => 'Mecz 3',
                'team_name_1' => 'Valencia CF',
                'team_name_2' => 'Atletico Madryt',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Niedziela,17-09-2023,21:00',
                'position' => 3,
            ),
            array(
                'meet_name' => 'Mecz 4',
                'team_name_1' => 'Bayern Monachium',
                'team_name_2' => 'Bayer Leverkusen',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Niemiecka',
                'term' => 'Piątek,15-09-2023,21:00',
                'position' => 4,
            ),
            array(
                'meet_name' => 'Mecz 5',
                'team_name_1' => 'VFL Wolfsburg',
                'team_name_2' => 'Union Berlin',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Niemiecka',
                'term' => 'Sobota,16-09-2023,15:30',
                'position' => 5,
            ),
            array(
                'meet_name' => 'Mecz 6',
                'team_name_1' => 'Juventus Turyn',
                'team_name_2' => 'Lazio Rzym',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Sobota,16-09-2023,15:00',
                'position' => 6,
            ),
            array(
                'meet_name' => 'Mecz 7',
                'team_name_1' => 'Inter Mediolan',
                'team_name_2' => 'AC Milan',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Niedziela,17-09-2023,18:00',
                'position' => 7,
            ),
            array(
                'meet_name' => 'Mecz 8',
                'team_name_1' => 'Fiorentina',
                'team_name_2' => 'Atalanta Bergamo',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Niedziela,17-09-2023,18:00',
                'position' => 8,
            ),
            array(
                'meet_name' => 'Mecz 9',
                'team_name_1' => 'Stade Rennes',
                'team_name_2' => 'Lille OSC',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Francuska',
                'term' => 'Niedziela,17-09-2023,16:00',
                'position' => 9,
            ),
            array(
                'meet_name' => 'Mecz 10',
                'team_name_1' => 'Everton FC',
                'team_name_2' => 'Arsenal Londyn',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Niedziela,17-09-2023,18:30',
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