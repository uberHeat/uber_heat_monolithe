<?php

declare(strict_types=1);

namespace App\Services\Updater;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserUpdater implements UpdaterInterface
{
    private ?UserInterface $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function update(object $object): void
    {
        if ($object instanceof User) {
            $user = $object;
        }
    }
}
