<?php

declare(strict_types=1);

namespace App\Services\Updater;

interface UpdaterInterface
{
    public function update(object $object): void;
}
