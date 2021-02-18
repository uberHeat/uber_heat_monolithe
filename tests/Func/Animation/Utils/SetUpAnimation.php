<?php

declare(strict_types=1);

namespace App\Tests\Func\Animation\Utils;

use App\Tests\EntityManager\EntityFactory;
use App\Tests\EntityManager\TestEntityManagerInterface;

trait SetUpAnimation
{
    protected object $animation;
    protected TestEntityManagerInterface $animationManager;
    protected TestEntityManagerInterface $userManager;
    protected string $randomPayload;

    protected object $author;
    protected array $authorLoginCredential;

    /* This function tearDown interact directly the database via doctrine */
    protected function setUp(): void
    {
        $factory = new EntityFactory($this->getEntityManager(), $this->getSecurityEncoder());
        $animationManager = $factory->create('animation');
        $this->animationManager = $animationManager;
        $this->animation = $this->animationManager->createOne();
        $this->randomPayload = $this->animationManager->getRandomPayload();

        $userManager = $factory->create('user');
        $this->userManager = $userManager;
        $this->author = $userManager->createOne();
        $this->authorLoginCredential = $userManager->getLoginInformation($this->author->getEmail(), $this->author->getPassword());
    }
}
