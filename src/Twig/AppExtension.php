<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension{
    
    protected $doctrine;

    public function getFunctions()
    {
        return [
            new TwigFunction('curr_matchday', [$this, 'getCurrentMatchday']),
            new TwigFunction('log_users', [$this, 'usersLogged']),
            new TwigFunction('find_matchday', [$this, 'getMatchdayByName']),
            new TwigFunction('compare_date', [$this, 'compareDate']),
            new TwigFunction('get_users', [$this, 'getUsers']),
            new TwigFunction('get_meets', [$this, 'meetsByMatchday']),
            new TwigFunction('is_typed', [$this, 'isTyped']),
            new TwigFunction('sum_comments', [$this, 'getSumComments']),
            new TwigFunction('get_season', [$this, 'getSeasonId']),
            new TwigFunction('get_season_name', [$this, 'getSeasonName']),
        ];

    }
    
    // get current matchday
    public function getCurrentMatchday(){
        $repository = $this->doctrine->getRepository('Matchday:class');
        $matchday = $repository->getMatchday();
        
        if($matchday == NULL){
            $matchday['id'] = 15;
            $matchday['name'] = 15;
            $matchday['finish'] = "finish";
        }
        
        return $matchday;
    }
    
    // get matchday by name
    public function getMatchdayByName($name){
        $repository = $this->doctrine->getRepository('Matchday:class');
        $matchday = $repository->findOneByName($name);

        return $matchday;
    }
    
    // compare date
    public function compareDate($id){
        
        $repository = $this->doctrine->getRepository('Matchday:class');
        $matchday = $repository->find($id);
        
        $currDate = \DateTime::createFromFormat('Y-m-d',date('Y-m-d'));
        $dateFrom =  $matchday->getDateFrom();
        $dateTo = $matchday->getDateTo();
        
        if($currDate < $dateFrom && $currDate < $dateTo){
            $nextMatchday = true;
        }else{
            $nextMatchday = false;
        }
        
        return $nextMatchday;
    }
    
    // get all users
    public function getUsers(){
        $userRepo = $this->doctrine->getRepository('User:class');
        $users = $userRepo->findByStatus(1);
        
        return $users;
    }
    
    // get current logged users
    public function usersLogged(){
        $repository = $this->doctrine->getRepository('User:class');
        $users = $repository->getActive();
        
        return $users;
    }
    
    // get current meets
    public function meetsByMatchday($matchday){
        $repository = $this->doctrine->getRepository('Meet:class');
        $meets = $repository->findBy(array('matchday' => $matchday));
        
        return $meets;
    }
    
    // is typed 
    public function isTyped($matchday, $user){
        
        $repository = $this->doctrine->getRepository('Type:class');
        $isTyped = $repository->getUserTypes($matchday, $user);
        
        if(count($isTyped) != 0){
            return true;
        }
        
        return false;
    }
    
    public function getSumComments($season){
        
        $repository = $this->doctrine->getRepository('Comment:class');
        $comment = $repository->findBySeason($season);
        
        $sum = count($comment);

        return $sum;
    }
    
    public function getSeasonId(){
        
        $repository = $this->doctrine->getRepository('Season:class');
        return $repository->getSeason();
        
    }
    
    public function getSeasonName($seasonId){
        
        $repository = $this->doctrine->getRepository('Season:class');
        $seasonName = $repository->find($seasonId);
        
//        var_dump($seasonName);
        
        return $seasonName->getName();
        
    }
    
}