<?php

namespace App\Service;

use App\Entity\Type;
use App\Entity\User;
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


}