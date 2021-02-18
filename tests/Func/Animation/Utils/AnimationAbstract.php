<?php

declare(strict_types=1);

namespace App\Tests\Func\Animation\Utils;

use App\Tests\Func\AbstractEndPoint;
use Faker\Factory;

abstract class AnimationAbstract extends AbstractEndPoint
{
    use AnimationManager;
    private string $animationPayload = '{"title": "%s", "shortDescription": "%s", "longDescription": "%s"}';

    protected function getRandomTitle(): string
    {
        $faker = Factory::create();

        return $faker->title;
    }

    protected function getRandomText(int $length): string
    {
        $faker = Factory::create();

        return $faker->text($length);
    }

    protected function getRandomPayload(): string
    {
        return sprintf($this->animationPayload, $this->getRandomTitle(), $this->getRandomText(random_int(20, 50)), $this->getRandomText(random_int(80, 200)));
    }

    protected function getCustomPayload(string $title, string $shortDescription, string $longDescription): string
    {
        return sprintf($this->animationPayload, $title, $shortDescription, $longDescription);
    }

    protected function getLoginInformation(string $email, string $password): array
    {
        return ['email' => $email, 'password' => $password];
    }
}
