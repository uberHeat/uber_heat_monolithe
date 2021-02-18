<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserRoleUpdater
{
    public function __invoke(User $data, EntityManagerInterface $manager): User
    {
        $manager->persist($data);
        $manager->flush();

        return $data;
    }
}
