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
                'team_name_1' => 'AC Milan',
                'team_name_2' => 'Tottenham Londyn',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Wtorek,14-02-2023,21:00',
                'position' => 1,
            ),
            array(
                'meet_name' => 'Mecz 2',
                'team_name_1' => 'Paris Saint-Germain',
                'team_name_2' => 'Bayern Monachium',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Wtorek,14-02-2023,21:00',
                'position' => 2,
            ),
            array(
                'meet_name' => 'Mecz 3',
                'team_name_1' => 'FC Brugge',
                'team_name_2' => 'Benfica Lizbona',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Środa,15-02-2023,21:00',
                'position' => 3,
            ),
            array(
                'meet_name' => 'Mecz 4',
                'team_name_1' => 'Borussia Dortmund',
                'team_name_2' => 'Chelsea Londyn',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Środa,15-02-2023,21:00',
                'position' => 4,
            ),
            array(
                'meet_name' => 'Mecz 5',
                'team_name_1' => 'Bodo Glimt',
                'team_name_2' => 'Lech Poznań',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Europy',
                'term' => 'Czwartek,16-02-2023,18:45',
                'position' => 5,
            ),
            array(
                'meet_name' => 'Mecz 6',
                'team_name_1' => 'SV Salzburg',
                'team_name_2' => 'AS Roma',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Europy',
                'term' => 'Czwartek,16-02-2023,18:45',
                'position' => 6,
            ),
            array(
                'meet_name' => 'Mecz 7',
                'team_name_1' => 'FC Barcelona',
                'team_name_2' => 'Manchester United',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Europy',
                'term' => 'Czwartek,16-02-2023,18:45',
                'position' => 7,
            ),
            array(
                'meet_name' => 'Mecz 8',
                'team_name_1' => 'Sevilla FC',
                'team_name_2' => 'PSV Eindhoven',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Europy',
                'term' => 'Czwartek,16-02-2023,18:45',
                'position' => 8,
            ),
            array(
                'meet_name' => 'Mecz 9',
                'team_name_1' => 'Newcastle United',
                'team_name_2' => 'Liverpool FC',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Sobota,18-02-2023,16:00',
                'position' => 9,
            ),
            array(
                'meet_name' => 'Mecz 10',
                'team_name_1' => 'Atletico Madryt',
                'team_name_2' => 'Athletic Bilbao',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Niedziela,19-02-2023,18:30',
                'position' => 10,
            ),

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