<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Updater\AnimationUpdater;
use App\Services\Updater\UserUpdater;

class UpdaterDispatcher implements UpdaterDispatcherInterface
{
    private AnimationUpdater $animationUpdater;
    private UserUpdater $userUpdater;

    public function __construct(
        AnimationUpdater $animationUpdater,
        UserUpdater $userUpdater
    ) {
        $this->animationUpdater = $animationUpdater;
        $this->userUpdater = $userUpdater;
    }

    public function dispatch(object $object): void
    {
        $methodName = strtolower($this->get_class_name(get_class($object))).'Updater';
        $this->$methodName->update($object);
    }

    private function get_class_name($classname): string
    {
        if ($pos = strrpos($classname, '\\')) {
            return substr($classname, $pos + 1);
        }
    }
}
