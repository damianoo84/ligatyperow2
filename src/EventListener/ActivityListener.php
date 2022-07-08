<?php

namespace App\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Doctrine\ORM\EntityManager;
use App\Entity\User;
use Psr\Log\LoggerInterface;

/**
 * Listener that updates the last activity of the authenticated user
 */
class ActivityListener
{
    protected $securityContext;
    protected $entityManager;
    private $logger;

    public function __construct(TokenStorageInterface $securityContext, EntityManager $entityManager, LoggerInterface $logger)
    {
        $this->securityContext = $securityContext;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
    * Update the user "lastActivity" on each request
    * @param FilterControllerEvent $event
    */
    public function onCoreController(ControllerEvent $event)
    {
        $this->logger->info('DC onCoreController');

        // Check that the current request is a "MASTER_REQUEST"
        // Ignore any sub-request
        if ($event->getRequestType() !== HttpKernel::MASTER_REQUEST) {
            return;
        }

        $this->logger->info('DC onCoreController 2');

        // Check token authentication availability
        if ($this->securityContext->getToken()) {

            $this->logger->info('DC onCoreController 3');

            $user = $this->securityContext->getToken()->getUser();

            if ( ($user instanceof User) && !($user->isActiveNow()) ) {

                $this->logger->info('DC onCoreController 4');

                $user->setLastActivityAt(new \DateTime());
                $this->entityManager->flush($user);
            }
        }
    }
}
