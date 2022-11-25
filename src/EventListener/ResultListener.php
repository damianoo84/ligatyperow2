<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Meet;
use App\Entity\Type;
use Psr\Log\LoggerInterface;

class ResultListener {
    
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function postUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        
        if ($entity instanceof Meet) {
            
            $meetId = $entity->getId();
            $typeRepo = $em->getRepository(Type::class);
            $types = $typeRepo->findByMeet($meetId);
            
            foreach ($types as $type) {
                
                    if (
                            ($type->getHostType() == $entity->getHostGoals()) && 
                            ($type->getGuestType() == $entity->getGuestGoals())
                        )
                    {
                        $this->logger->info('Update set 4 points');
                        $type->setNumberOfPoints(4);
                    } elseif (
                                // typ1 > typ2 i wynik1 > wynik2
                                ($type->getHostType() > $type->getGuestType()) && 
                                ($entity->getHostGoals() > $entity->getGuestGoals())
                             )
                    {
                        $this->logger->info('Update set 2 points (option 1)');
                        $type->setNumberOfPoints(2);
                    } elseif (
                                // typ1 < typ2 i wynik1 < wynik2
                                ($type->getHostType() < $type->getGuestType()) && 
                                ($entity->getHostGoals() < $entity->getGuestGoals())
                             )
                    {
                        $this->logger->info('Update set 2 points (option 2)');
                        $type->setNumberOfPoints(2);
                    } elseif (
                                // typ1 == typ2 i wynik1 == wynik2 i typ1 <> wynik1
                                ($type->getHostType() == $type->getGuestType()) && 
                                ($entity->getHostGoals() == $entity->getGuestGoals()) && 
                                ($type->getHostType() <> $entity->getHostGoals())
                             )
                    {
                        $this->logger->info('$type->getHostType(): ' . $type->getHostType());
                        $this->logger->info('$type->getGuestType(): ' . $type->getGuestType());
                        $this->logger->info('$entity->getHostGoals(): ' . $entity->getHostGoals());
                        $this->logger->info('$entity->getGuestGoals(): ' . $entity->getGuestGoals());
                        $this->logger->info('Update set 2 points (option 3)');
                        
                        if ($entity->getHostGoals() == '') {
                            $this->logger->info('test1'); // tak
                        }
                        
                        if ($entity->getHostGoals() == NULL) {
                            $this->logger->info('test2'); // tak
                        }
                        
                        if ($entity->getHostGoals() == "") {
                            $this->logger->info('test3'); // tak
                        }
                        
                        if ($entity->getHostGoals() == ' ') {
                            $this->logger->info('test4');
                        }
                        
                        if ($entity->getHostGoals() == " ") {
                            $this->logger->info('test5');
                        } 
                        
                        if (empty($entity->getHostGoals())) {
                            $this->logger->info('test6'); // tak
                        }
                        
                        $type->setNumberOfPoints(2);     
                    } elseif (
                                // typ 2-1 wynik 0-0
                                // typ 2-1 wynik 1-2
                                // typ 1-1 wynik 2-1
                                // typ 1-1 wynik 1-2
                                // typ 1-2 wynik 1-1
                                // typ 1-2 wynik 2-1

                                // typ1 > typ2 i wynik1 == wynik2
                                // typ1 > typ2 i wynik1 < wynik2
                                // typ1 == typ2 i wynik1 > wynik2
                                // typ1 == typ2 i wynik1 < wynik2
                                // typ1 < typ2 i wynik1 == wynik2
                                // typ1 < typ2 i wynik1 > wynik2

                                (($type->getHostType() > $type->getGuestType()) &&
                                ($entity->getHostGoals() == $entity->getGuestGoals())) || 

                                (($type->getHostType() > $type->getGuestType()) &&
                                ($entity->getHostGoals() < $entity->getGuestGoals())) || 

                                (($type->getHostType() == $type->getGuestType()) &&
                                ($entity->getHostGoals() > $entity->getGuestGoals())) || 

                                (($type->getHostType() == $type->getGuestType()) &&
                                ($entity->getHostGoals() < $entity->getGuestGoals())) || 

                                (($type->getHostType() < $type->getGuestType()) &&
                                ($entity->getHostGoals() == $entity->getGuestGoals())) || 

                                (($type->getHostType() < $type->getGuestType()) &&
                                ($entity->getHostGoals() > $entity->getGuestGoals())) 
                            ) 
                    {
                        $this->logger->info('Update set 0 points');
                        $type->setNumberOfPoints(0);
                    } else {
                        $this->logger->info('NO UPDATE!');
                    }

                    $em->persist($type);
                    $em->flush();
            }
            
//            $em->flush();
        }
    } 
}