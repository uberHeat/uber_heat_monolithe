<?php

declare(strict_types=1);

namespace App\Services;

interface ResourceUpdaterInterface
{
    public function isAnUpdate(string $method): bool;
}
