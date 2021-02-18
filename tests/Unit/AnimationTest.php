<?php

namespace App\Tests\Unit;

use App\Entity\Animation;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class AnimationTest extends TestCase
{
    private Animation $Animation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->Animation = new Animation();
    }

    /**
     * @group unit
     * @group unitAnimation
     */
    public function testGetTitle(): void
    {
        $value = 'My title';
        $response = $this->Animation->setTitle($value);

        self::assertInstanceOf(Animation::class, $response);
        self::assertEquals($value, $this->Animation->getTitle());
        self::assertEquals($value, $this->Animation->getTitle());
    }

    /**
     * @group unit
     * @group unitAnimation
     */
    public function testGetShortDescription(): void
    {
        $value = 'My short description here';
        $response = $this->Animation->setShortDescription($value);

        self::assertInstanceOf(Animation::class, $response);
        self::assertEquals($value, $this->Animation->getShortDescription());
        self::assertEquals($value, $this->Animation->getShortDescription());
    }

    /**
     * @group unit
     * @group unitAnimation
     */
    public function testGetLongDescription(): void
    {
        $value = 'My long description here';
        $response = $this->Animation->setLongDescription($value);

        self::assertInstanceOf(Animation::class, $response);
        self::assertEquals($value, $this->Animation->getLongDescription());
        self::assertEquals($value, $this->Animation->getLongDescription());
    }

    /**
     * @group unit
     * @group unitAnimation
     */
    public function testAddAndDeleteUsersIntoAnAnimation(): void
    {
        $value = new User();

        $response = $this->Animation->addUser($value);

        self::assertInstanceOf(Animation::class, $response);
        self::assertCount(1, $this->Animation->getusers());
        self::assertTrue($this->Animation->getusers()->contains($value));

        $response = $this->Animation->removeUser($value);
        self::assertInstanceOf(Animation::class, $response);
        self::assertCount(0, $this->Animation->getusers());
        self::assertFalse($this->Animation->getusers()->contains($value));
    }
}
