<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Configuration;
use App\Entity\Product;
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
        $this->createProduct($manager, random_int(5, 15));
        $manager->flush();
    }

    private function createUsers(ObjectManager $manager, int $userNumber): void
    {
        for ($i = 0; $i < $userNumber; ++$i) {
            $user = new User();
            $user->setEmail($this->faker->email)
                ->setPassword($this->hashPassword($user, 'password'));
            $manager->persist($user);
        }
    }

    private function createProduct(ObjectManager $manager, int $productNumber): void
    {
        for ($j = 0; $j < $productNumber; ++$j) {
            $tempProduct = (new Product())
                ->setName($this->faker->text(20))
            ->addConfiguration($this->createConfiguration($manager));

            $manager->persist($tempProduct);
        }
    }

    private function createConfiguration(ObjectManager $manager): Configuration
    {
        $tempConfiguration = (new Configuration());
        $manager->persist($tempConfiguration);

        return $tempConfiguration;
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
