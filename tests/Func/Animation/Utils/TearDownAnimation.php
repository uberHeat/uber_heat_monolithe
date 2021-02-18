<?php

declare(strict_types=1);

namespace App\Tests\Func\Animation\Utils;

trait TearDownAnimation
{
    /* This function tearDown interact directly the database via doctrine */
    protected function tearDown(): void
    {
        $this->deleteOneAnimation($this->animation->getId());
    }
}
