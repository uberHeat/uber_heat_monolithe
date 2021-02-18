<?php

declare(strict_types=1);

namespace App\Tests\EntityManager;

interface TestEntityManagerInterface
{
    public function createOne(): object;

    public function getOne(int $id): ?object;

    public function deleteOne(int $id): void;

    public function getRandomPayload(): string;
}
