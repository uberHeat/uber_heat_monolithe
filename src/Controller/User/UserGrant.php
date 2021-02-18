<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserGrant
{
    public function __invoke(User $data, EntityManagerInterface $manager): User
    {
        $data->setRoles(['ROLE_ADMIN']);
        $manager->persist($data);
        $manager->flush();

        return $data;
    }
}
