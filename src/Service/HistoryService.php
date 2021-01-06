<?php


namespace App\Service;
use Symfony\Component\HttpFoundation\Request;
use App\Twig\AppExtension;
use App\Entity\History;
use Doctrine\ORM\EntityManagerInterface;


class HistoryService
{
    private $appExtension;
    private $entityManager;

    public function __construct(AppExtension $appExtension, EntityManagerInterface $entityManager) {
        $this->appExtension = $appExtension;
        $this->entityManager = $entityManager;
    }

    public function getHistory(Request $request) : array {

        $repository = $this->entityManager->getRepository(History::class);
        $history = $repository->getHistory($request->get('season'));
        return $history;
    }

}