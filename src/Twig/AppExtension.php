<?php

namespace App\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;

class AppExtension extends \Twig_Extension{
    
    protected $doctrine;
    
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('curr_matchday', array($this, 'getCurrentMatchday')),
            new \Twig_SimpleFunction('log_users', array($this, 'usersLogged')),
            new \Twig_SimpleFunction('find_matchday', array($this, 'getMatchdayByName')),
            new \Twig_SimpleFunction('compare_date', array($this, 'compareDate')),
            new \Twig_SimpleFunction('get_users', array($this, 'getUsers')),
            new \Twig_SimpleFunction('get_meets', array($this, 'meetsByMatchday')),
            new \Twig_SimpleFunction('is_typed', array($this, 'isTyped')),
            new \Twig_SimpleFunction('sum_comments', array($this, 'getSumComments')),
            new \Twig_SimpleFunction('get_season', array($this, 'getSeasonId')),
            new \Twig_SimpleFunction('get_season_name', array($this, 'getSeasonName')),
        );
    }
    
    // get current matchday
    public function getCurrentMatchday(){
        $repository = $this->doctrine->getRepository('AppBundle:Matchday');
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
        $repository = $this->doctrine->getRepository('AppBundle:Matchday');
        $matchday = $repository->findOneByName($name);

        return $matchday;
    }
    
    // compare date
    public function compareDate($id){
        
        $repository = $this->doctrine->getRepository('AppBundle:Matchday');
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
        $userRepo = $this->doctrine->getRepository('AppBundle:User');
        $users = $userRepo->findByStatus(1);
        
        return $users;
    }
    
    // get current logged users
    public function usersLogged(){
        $repository = $this->doctrine->getRepository('AppBundle:User');
        $users = $repository->getActive();
        
        return $users;
    }
    
    // get current meets
    public function meetsByMatchday($matchday){
        $repository = $this->doctrine->getRepository('AppBundle:Meet');
        $meets = $repository->findBy(array('matchday' => $matchday));
        
        return $meets;
    }
    
    // is typed 
    public function isTyped($matchday, $user){
        
        $repository = $this->doctrine->getRepository('AppBundle:Type');
        $isTyped = $repository->getUserTypes($matchday, $user);
        
        if(count($isTyped) != 0){
            return true;
        }
        
        return false;
    }
    
    public function getSumComments($season){
        
        $repository = $this->doctrine->getRepository('AppBundle:Comment');
        $comment = $repository->findBySeason($season);
        
        $sum = count($comment);

        return $sum;
    }
    
    public function getSeasonId(){
        
        $repository = $this->doctrine->getRepository('AppBundle:Season');
        $season = $repository->getSeason();
        
        return $season;
        
    }
    
    public function getSeasonName($seasonId){
        
        $repository = $this->doctrine->getRepository('AppBundle:Season');
        $seasonName = $repository->find($seasonId);
        
//        var_dump($seasonName);
        
        return $seasonName->getName();
        
    }
    
}