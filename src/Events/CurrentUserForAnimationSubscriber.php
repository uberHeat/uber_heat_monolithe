<?php
/*
 *  Ce fichier contient un evenement se declanchant avant la creation d'une Animation.
 *  Cet evenement permet d'ajouter automatiquement l'utilisateur connecter en temps que 'autheur' de l'animation.
 *  Les jointures entre les table se font automatiquement grace a l'ORM Doctrine
 *  Techniquement doctrine ajoute a la table de jointure 'animation_user' l'id de l'utilisateur courant ainsi que l'id de l'animation.
*/

declare(strict_types=1);

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Animation;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class CurrentUserForAnimationSubscriber implements EventSubscriberInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['currentUserForAnimations', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function currentUserForAnimations(ViewEvent $event): void
    {
        $animation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($animation instanceof Animation && Request::METHOD_POST === $method) {
            $animation->addUser($this->security->getUser());
        }
    }
}
