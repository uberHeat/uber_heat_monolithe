<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Animation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    const DEFAULT_USER = ['email' => 'admin@mail.com', 'password' => 'password'];
    private UserPasswordEncoderInterface $encoder;
    private $defaultUser;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->createDefaultUser($manager);
        $this->createUsers($manager, 10);

        $manager->flush();
    }

    private function createUsers(ObjectManager $manager, int $userNumber): void
    {
        for ($i = 0; $i < $userNumber; ++$i) {
            $user = new User();
            $user->setEmail($this->faker->email)
                ->setPassword($this->hashPassword($user, 'password'));
            $manager->persist($user);

            $this->createAnimations($manager, $user, random_int(5, 15));
        }
    }

    private function createAnimations(ObjectManager $manager, User $userAuthor, int $animationNumber): void
    {
        for ($j = 0; $j < $animationNumber; ++$j) {
            $Animation = (new Animation())->addUser($userAuthor)
                ->addUser($this->defaultUser)
                ->setTitle($this->faker->text(20))
                ->setShortDescription($this->faker->text(100))
                ->setLongDescription($this->faker->text(300));

            $manager->persist($Animation);
        }
    }

    private function createDefaultUser(ObjectManager $manager): void
    {
        $this->defaultUser = new User();
        $this->defaultUser->setEmail(self::DEFAULT_USER['email'])
            ->setPassword($this->hashPassword($this->defaultUser, self::DEFAULT_USER['password']));
        $manager->persist($this->defaultUser);
    }

    private function hashPassword(User $user, string $password): string
    {
        return $this->encoder->encodePassword($user, $password);
    }
}
