<?php

declare(strict_types=1);

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Services\ResourceUpdaterInterface;
use App\Services\UpdaterDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResourceUpdaterSubscriber implements EventSubscriberInterface
{
    private ResourceUpdaterInterface $resourceUpdater;
    private UpdaterDispatcherInterface $updaterDispatcher;

    public function __construct(ResourceUpdaterInterface $resourceUpdater, UpdaterDispatcherInterface $updaterDispatcher)
    {
        $this->resourceUpdater = $resourceUpdater;
        $this->updaterDispatcher = $updaterDispatcher;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['check', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function check(ViewEvent $event): void
    {
        $object = $event->getControllerResult();

        $isAnUpdate = $this->resourceUpdater->isAnUpdate($event->getRequest()->getMethod());

        if ($isAnUpdate) {
            $this->updaterDispatcher->dispatch($object);

            $object->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}
