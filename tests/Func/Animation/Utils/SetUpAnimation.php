<?php

declare(strict_types=1);

namespace App\Tests\Func\Animation\Utils;

use App\Entity\Animation;

trait SetUpAnimation
{
    protected Animation $animation;

    /* This function tearDown interact directly the database via doctrine */
    protected function setUp(): void
    {
        $this->animation = $this->createRandomAnimation();
    }
}
