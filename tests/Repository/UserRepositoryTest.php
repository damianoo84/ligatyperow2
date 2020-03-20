<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testShouldCheckActiveUsers() {

        $users = $this->entityManager->getRepository(User::class)->getActive();
        $this->assertNotNull($users);

    }

    public function testShouldCountNumberOfActiveUsers() {

        $activeUsers = $this->entityManager->getRepository(User::class)->findBy(array('status' => 1));
        $this->assertEquals(10,count($activeUsers));

    }

    protected function tearDown()
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}