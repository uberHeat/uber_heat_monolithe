<?php

declare(strict_types=1);

namespace App\Tests\Func\User\Utils;

use App\Tests\EntityManager\EntityFactory;
use App\Tests\EntityManager\TestEntityManagerInterface;

trait SetUpUser
{
    protected object $user;
    protected TestEntityManagerInterface $userManager;
    protected string $randomPayload;
    protected array $userLoginCredential;

    /* This function tearDown interact directly the database via doctrine */
    protected function setUp(): void
    {
        $factory = new EntityFactory($this->getEntityManager(), $this->getSecurityEncoder());
        $userManager = $factory->create('user');
        $this->userManager = $userManager;
        $this->user = $this->userManager->createOne();
        $this->randomPayload = $this->userManager->getRandomPayload();
        $this->userLoginCredential = $userManager->getLoginInformation($this->user->getEmail(), $this->user->getPassword());
    }
}
