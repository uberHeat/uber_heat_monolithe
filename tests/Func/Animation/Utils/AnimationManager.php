<?php

namespace App\Tests\Func\Animation\Utils;

use App\Entity\Animation;

trait AnimationManager
{
    protected function deleteOneAnimation(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $animationToDelete = $this->getOneAnimation($id);
        if (null !== $animationToDelete && $animationToDelete instanceof Animation) {
            $entityManager->remove($animationToDelete);
            $entityManager->flush();
            $entityManager->clear();
        }
    }

    protected function getOneAnimation(int $id): ?Animation
    {
        $entityManager = $this->getEntityManager();

        $result = $entityManager
            ->getRepository(Animation::class)
            ->find($id);
        if (null !== $result && $result instanceof Animation) {
            return $result;
        }

        return null;
    }

    protected function createRandomAnimation(): Animation
    {
        $entityManager = $this->getEntityManager();
        $animationTemp = new Animation();

        $animationTemp->setTitle($this->getRandomTitle())
        ->setShortDescription($this->getRandomText(random_int(20, 50)))
        ->setLongDescription($this->getRandomText(random_int(80, 200)));

        $entityManager->persist($animationTemp);
        $entityManager->flush();
        $entityManager->clear();

        return $animationTemp;
    }
}
