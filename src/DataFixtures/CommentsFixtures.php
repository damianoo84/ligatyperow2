<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Comment;

class CommentsFixtures extends Fixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager) {
        
        $commentsList = array(
            array(
                'text' => 'cos tam cos tam cos tam 1',
                'nick' => 'Damian',
                'season_name' => 'Wiosna 2018'
            ),
            array(
                'text' => 'cos tam cos tam cos tam 2',
                'nick' => 'Kuba1',
                'season_name' => 'Wiosna 2018'
            ),
            array(
                'text' => 'cos tam cos tam cos tam 3',
                'nick' => 'Marcin1',
                'season_name' => 'Wiosna 2018'
            )
            
        );
        
        foreach ($commentsList as $commentsDetails) {
            $comment = new Comment();
            $comment->setText($commentsDetails['text']);
            $comment->setSeason($this->getReference('season-'.$commentsDetails['season_name']));
            $comment->setUser($this->getReference('user-'.$commentsDetails['nick']));

            $manager->persist($comment);
        }
        
        $manager->flush();
    }
    
}