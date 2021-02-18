<?php

declare(strict_types=1);

namespace App\Services\Updater;

use App\Entity\Animation;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class AnimationUpdater implements UpdaterInterface
{
    private ?UserInterface $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function update(object $object): void
    {
        if ($object instanceof Animation) {
            $animation = $object;
            $this->addUserToTheAnimation($animation);
        }
    }

    private function addUserToTheAnimation(Animation $animation): void
    {
        if (null !== $this->user) {
            $animation->addUser($this->user);
            $this->user->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}
