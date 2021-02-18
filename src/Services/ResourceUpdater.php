<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

class ResourceUpdater implements ResourceUpdaterInterface
{
    protected array $methodToInteractWith = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
    ];

    public function isAnUpdate(string $method): bool
    {
        if (in_array($method, $this->methodToInteractWith, true)) {
            return true;
        }

        return false;
    }
}
