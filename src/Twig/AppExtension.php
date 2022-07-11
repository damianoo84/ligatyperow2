<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Matchday;
use App\Entity\User;
use App\Entity\Meet;
use App\Entity\Comment;
use App\Entity\Type;
use App\Entity\Season;
use Psr\Log\LoggerInterface;

class AppExtension extends AbstractExtension{
    
    protected $doctrine;
    private $logger;

    public function __construct(ManagerRegistry $doctrine, LoggerInterface $logger)
    {
        $this->doctrine = $doctrine;
        $this->logger = $logger;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('curr_matchday', array($this, 'getCurrentMatchday')),
            new TwigFunction('log_users', array($this, 'usersLogged')),
            new TwigFunction('find_matchday', array($this, 'getMatchdayByName')),
            new TwigFunction('compare_date', array($this, 'compareDate')),
            new TwigFunction('get_users', array($this, 'getUsers')),
            new TwigFunction('get_meets', array($this, 'meetsByMatchday')),
            new TwigFunction('is_typed', array($this, 'isTyped')),
            new TwigFunction('sum_comments', array($this, 'getSumComments')),
            new TwigFunction('get_season', array($this, 'getSeasonId')),
            new TwigFunction('get_season_name', array($this, 'getSeasonName')),
            new TwigFunction('prev_matchday', array($this, 'getPreviousMatchday'))
        );

    }
    
    // get current matchday
    public function getCurrentMatchday(){
        $repository = $this->doctrine->getRepository(Matchday::class);
        $matchday = $repository->getMatchday();
        
        if($matchday == NULL){
            $matchday['id'] = 15;
            $matchday['name'] = 15;
            $matchday['finish'] = "finish";
        }
        
        return $matchday;
    }

    public function getPreviousMatchday() {

        $repository = $this->doctrine->getRepository((Matchday::class));
        $matchday = $repository->getPreviuosMatchday();

        if($matchday == NULL){
            $matchday['id'] = 15;
            $matchday['name'] = 15;
            $matchday['finish'] = "finish";
        }

        return $matchday;

    }

    // get matchday by name
    public function getMatchdayByName($name){
        $repository = $this->doctrine->getRepository(Matchday::class);
        $matchday = $repository->findOneByName($name);

        return $matchday;
    }
    
    // compare date
    public function compareDate($id){
        
        $repository = $this->doctrine->getRepository(Matchday::class);
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
        $userRepo = $this->doctrine->getRepository(User::class);
        $users = $userRepo->findByStatus(1);
        
        return $users;
    }
    
    // get current logged users
    public function usersLogged(){

        $this->logger->info('DC get current logged users');

        $repository = $this->doctrine->getRepository(User::class);
        $users = $repository->getActive();

        $this->logger->info('DC count $users: ' . count($users));

        foreach ($users as $key => $value) {
            $this->logger->info('DC $users , key: ' . $key);
        }

        return $users;
    }
    
    // get current meets
    public function meetsByMatchday($matchday){
        $repository = $this->doctrine->getRepository(Meet::class);
        $meets = $repository->findBy(array('matchday' => $matchday));
        
        return $meets;
    }
    
    // is typed 
    public function isTyped($matchday, $user){
        
        $repository = $this->doctrine->getRepository(Type::class);
        $isTyped = $repository->getUserTypes($matchday, $user);
        
        if(count($isTyped) != 0){
            return true;
        }
        
        return false;
    }
    
    public function getSumComments($season){
        
        $repository = $this->doctrine->getRepository(Comment::class);
        $comment = $repository->findBySeason($season);
        
        $sum = count($comment);

        return $sum;
    }
    
    public function getSeasonId(){
        
        $repository = $this->doctrine->getRepository(Season::class);
        return $repository->getSeason();
        
    }
    
    public function getSeasonName($seasonId){
        
        $repository = $this->doctrine->getRepository(Season::class);
        $seasonName = $repository->find($seasonId);

        return $seasonName->getName();
        
    }
    
}