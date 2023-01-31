<?php

namespace App\Service;

use App\Entity\User;
use App\Twig\AppExtension;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private $appExtension;
    private $entityManager;

    public function __construct(AppExtension $appExtension, EntityManagerInterface $entityManager) {
        $this->appExtension = $appExtension;
        $this->entityManager = $entityManager;
    }

    public function getActiveUsers() : array {
        $repository = $this->entityManager->getRepository(User::class);
        $users = $repository->findByStatus(1);
        return $users;
    }

}