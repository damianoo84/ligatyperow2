<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\League;

class LeagueFixtures extends Fixture implements OrderedFixtureInterface{

    public function getOrder() {
        return 0;
    }
    
    public function load(ObjectManager $manager) {
        
        $leaguesList = array(
            'Liga Mistrzów',
            'Liga Europy',
            'Liga Polska',
            'Liga Hiszpańska',
            'Liga Angielska',
            'Liga Włoska',
            'Liga Niemiecka',
            'Liga Francuska',
            'Liga Grecka',
            'Liga Turecka',
            'Liga Szkocka',
            'Liga Holenderska',
            'Liga Portugalska',
            'Liga Rosyjska',
            'Liga Ukraińska',
            'Liga Chorwacka',
            'el. Mistrzostw Świata',
            'el. Mistrzostw Europy',
            'Mecz towarzyski',
            'Klubowe Mistrzostwa Świata',
            'Puchar Anglii',
            'Puchar Włoch',
            'Puchar Hiszpanii',
            'Puchar Niemiec',
            'Puchar Francji',
            'Puchar Ligi Angielskiej',
            'Puchar Ligi Francuskiej',
            'Puchar Polski',
            'Liga Narodów',
            'Liga Belgijska',
            'Reprezentacja'
        );
        
        $i = 1;
        foreach ($leaguesList as $leagueDetails){
            $league = new League();
            $league->setName($leagueDetails);
            $this->addReference('League-'.$leagueDetails, $league);
            
            $manager->persist($league);
            $i++;
        }
        
        $manager->flush();
    }
    
}