<?php

namespace App\Service;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Meet;
use App\Twig\AppExtension;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TypeService
{
    private $appExtension;
    private $entityManager;

    public function __construct(AppExtension $appExtension, EntityManagerInterface $entityManager) {
        $this->appExtension = $appExtension;
        $this->entityManager = $entityManager;
    }

    public function getPointsPerMatchday() : array {

        $matchday = $this->appExtension->getCurrentMatchday();

        $repository = $this->entityManager->getRepository(Type::class);
        $points = $repository->getPointsPerMatchday($matchday['id']);

        return $points;
    }

    public function getUsersTypes(Request $request) : array {

        $matchday = $this->appExtension->getMatchdayByName($request->get('matchday'));

        $repository = $this->entityManager->getRepository(Type::class);
        $points = $repository->getUsersTypes($matchday->getName(), $matchday->getSeason()->getId());

        return $points;
    }

    public function getRanking() : array {

        $repository = $this->entityManager->getRepository(User::class);
        $ranks = $repository->getRanking();

        return $ranks;
    }

    public function getUserTypes($id) : array {

        $matchday = $this->appExtension->getCurrentMatchday();

        $repository = $this->entityManager->getRepository(Type::class);
        $types = $repository->getUserTypes($matchday['id'], $id);

        return $types;
    }

    public function getMeets() : array {

        $matchday = $this->appExtension->getCurrentMatchday();

        $repository = $this->entityManager->getRepository(Meet::class);
        $meets = $repository->getMeetsPerMatchday($matchday['id']);

        return $meets;

    }

    public function getMeetsPerMatchday(Request $request, User $user){

        $req = $request->request->all();
        $repository = $this->entityManager->getRepository(Meet::class);

        $data = array();
        $counter = count(current($req));
        foreach (array_keys($req) as $key) {
            for($i=0; $i<$counter; $i++) {
                $data[$i][$key] = $req[$key][$i];
            }
        }

        foreach ($data as $key){
            $type = new Type();
            $meet = new Meet();
            $meet = $repository->findOneById($key['meet_id']);
            $type->setHostType($key['hostType']);
            $type->setGuestType($key['guestType']);
            $type->setNumberOfPoints(0);
            $type->setUser($user);
            $type->setMeet($meet);

            $em = $this->entityManager;
            $em->persist($meet);
            $em->persist($type);

        }
        $em->flush();

    }
}