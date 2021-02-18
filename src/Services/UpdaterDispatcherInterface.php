<?php

declare(strict_types=1);

namespace App\Services;

interface UpdaterDispatcherInterface
{
    public function dispatch(object $object): void;
}
