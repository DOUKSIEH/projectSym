<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase{


    /**
    * @var \Doctrine\ORM\EntityManager
    */
    private $entityManager;

    /**
    * {@inheritDoc}
    */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
                                      ->get('doctrine')
                                      ->getManager();
    }

    public function testfindLastest()
    {
        $user = $this->entityManager
                     ->getRepository(User::class)
                     ->findLastest() ;

        $this->assertCount(4, $user,"Coucou, ça marche pas !!!");
    }
     /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
   
}