<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    /**
     * @group unit
     * @group unitUser
     */
    public function testGetEmail(): void
    {
        $value = 'test@test.fr';
        $response = $this->user->setEmail($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getEmail());
        self::assertEquals($value, $this->user->getUsername());
    }

    /**
     * @group unit
     * @group unitUser
     */
    public function testGetRoles(): void
    {
        $value = ['ROLE_ADMIN'];
        $response = $this->user->setRoles($value);

        self::assertInstanceOf(User::class, $response);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    /**
     * @group unit
     * @group unitUser
     */
    public function testGetPassword(): void
    {
        $value = 'password';
        $response = $this->user->setPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertStringContainsString($value, $this->user->getPassword());
    }
}
