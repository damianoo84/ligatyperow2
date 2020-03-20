<?php

namespace App\Service;

use App\Entity\Type;
use App\Twig\AppExtension;
use Doctrine\ORM\EntityManagerInterface;

class TypeService
{
    private $appExtension;
    private $entityManager;

    public function __construct(AppExtension $appExtension, EntityManagerInterface $entityManager) {
        $this->appExtension = $appExtension;
        $this->entityManager = $entityManager;
    }

    public function getPointsPerMatchday() : array
    {

        $matchday = $this->appExtension->getCurrentMatchday();

        $repository = $this->entityManager->getRepository(Type::class);
        $points = $repository->getPointsPerMatchday($matchday['id']);

        return $points;
    }


}