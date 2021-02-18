<?php

namespace App\Tests\Func\User\Utils;

use App\Entity\User;

trait UserManager
{
    protected function deleteOneUser(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $userToDelete = $this->getOneUser($id);
        if (null !== $userToDelete && $userToDelete instanceof User) {
            $entityManager->remove($userToDelete);
            $entityManager->flush();
            $entityManager->clear();
        }
    }

    protected function getOneUser(int $id): ?User
    {
        $entityManager = $this->getEntityManager();

        $result = $entityManager
            ->getRepository(User::class)
            ->find($id);
        if (null !== $result && $result instanceof User) {
            return $result;
        }

        return null;
    }

    protected function createRandomUser(): User
    {
        $entityManager = $this->getEntityManager();
        $userTemp = new User();

        $randomEmail = $this->getRandomEmail();
        $randomPassword = $this->getRandomPassword();
        $hashPassword = $this->hashPassword($userTemp, $randomPassword);

        $userTemp->setPassword($hashPassword)
            ->setEmail($randomEmail)
            ->setUpdatedAt(null);

        $entityManager->persist($userTemp);
        $entityManager->flush();

        $userTemp = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $randomEmail]);
        $userTemp->setPassword($randomPassword);

        $entityManager->clear();

        return $userTemp;
    }
}
