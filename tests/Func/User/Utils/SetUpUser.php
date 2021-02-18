<?php

declare(strict_types=1);

namespace App\Tests\Func\User\Utils;

use App\Entity\User;

trait SetUpUser
{
    protected User $user;

    /* This function tearDown interact directly the database via doctrine */
    protected function setUp(): void
    {
        $this->user = $this->createRandomUser();
    }
}
