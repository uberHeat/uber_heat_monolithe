<?php

declare(strict_types=1);

namespace App\Tests\Func\User\Utils;

trait TearDownUser
{
    /* This function tearDown interact directly the database via doctrine */
    protected function tearDown(): void
    {
        $this->deleteOneUser($this->user->getId());
    }
}
