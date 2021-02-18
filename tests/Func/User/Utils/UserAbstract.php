<?php

declare(strict_types=1);

namespace App\Tests\Func\User\Utils;

use App\Entity\User;
use App\Tests\Func\AbstractEndPoint;
use Faker\Factory;

abstract class UserAbstract extends AbstractEndPoint
{
    use UserManager;
    private string $userPayload = '{"email":"%s", "password":"%s"}';

    protected function getRandomEmail(): string
    {
        $faker = Factory::create();

        return $faker->email;
    }

    protected function getRandomPassword(bool $withOutSpecialCharacter = true): string
    {
        $faker = Factory::create();
        if (true === $withOutSpecialCharacter) {
            return $this->removeSpecialCharacter($faker->password);
        } else {
            return $faker->password;
        }
    }

    protected function getRandomPayload(): string
    {
        $faker = Factory::create();

        return sprintf($this->userPayload, $faker->email, 'password');
    }

    protected function getCustomPayload(string $email, string $password): string
    {
        return sprintf($this->userPayload, $email, $password);
    }

    protected function getLoginInformation(string $email, string $password): array
    {
        return ['email' => $email, 'password' => $password];
    }

    private function removeSpecialCharacter(string $passwordGeneratedByFaker): string
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $passwordGeneratedByFaker); // Removes special chars.
    }

    protected function hashPassword(User $user, string $password): string
    {
        return $this->getSecurityEncoder()->encodePassword($user, $password);
    }
}
