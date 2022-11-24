<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Meet;
use App\Entity\Type;

class ResultListener {
    
    public function postUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        
        if ($entity instanceof Meet) {
            $meetId = $entity->getId();
            $typeRepo = $em->getRepository(Type::class);
            $types = $typeRepo->findByMeet($meetId);
            
            foreach ($types as $type) {
                if (($type->getHostType() == $entity->getHostGoals()) && ($type->getGuestType() == $entity->getGuestGoals())){
                        $type->setNumberOfPoints(4);
                } elseif (
                            // typ1 > typ2 i wynik1 > wynik2
                            ($type->getHostType() > $type->getGuestType()) && 
                            ($entity->getHostGoals() > $entity->getGuestGoals()) 
                        )
                    {
                        $type->setNumberOfPoints(2);
                } elseif (
                            // typ1 < typ2 i wynik1 < wynik2
                            ($type->getHostType() < $type->getGuestType()) && 
                            ($entity->getHostGoals() < $entity->getGuestGoals())
                        )
                    {
                        $type->setNumberOfPoints(2);
                } elseif (
                            // typ1 == typ2 i wynik1 == wynik2 i typ1 <> wynik1
                            ($type->getHostType() == $type->getGuestType()) && 
                            ($entity->getHostGoals() == $entity->getGuestGoals()) && 
                            ($type->getHostType() <> $entity->getHostGoals())
                        )
                    {
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
                        
                ) {
                    $type->setNumberOfPoints(0);
                }
                
                $em->persist($type);
            }
            $em->flush();
        }
    } 
}