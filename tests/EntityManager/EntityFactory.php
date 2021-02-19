<?php

namespace App\Tests\EntityManager;

use App\Tests\EntityManager\User\UserManager;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class EntityFactory
{
    private ObjectManager $objectManager;
    private UserPasswordEncoder $passwordEncoder;

    public function __construct(ObjectManager $objectManager, UserPasswordEncoder $passwordEncoder)
    {
        $this->objectManager = $objectManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function create($type): TestEntityManagerInterface
    {
        switch ($type) {
            case 'user':
                $response = new UserManager($this->objectManager, $this->passwordEncoder);
                break;
            default:
                $response = null;
        }

        return $response;
    }
}
