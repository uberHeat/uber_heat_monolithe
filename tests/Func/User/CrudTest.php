<?php

declare(strict_types=1);

namespace App\Tests\Func\User;

/* Trait importation */
use App\Tests\Func\User\Utils\SetUpUser;
use App\Tests\Func\User\Utils\TearDownUser;
use App\Tests\Func\User\Utils\UserAbstract;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CrudTest extends UserAbstract
{
    use SetUpUser;
    use TearDownUser;

    /**
     * @group func
     * @group funcUser
     * @group crudUser
     */
    public function testGetUsers(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET,
            '/api/users'
        );
        $responseContent = $response->getContent();

        $responseDecoded = json_decode($responseContent);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    /**
     * @group func
     * @group funcUser
     * @group crudUser
     */
    public function testPostUser(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_POST,
            '/api/users',
            $this->getRandomPayload()
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent, true);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);

        /* Delete the user previously created */
        $this->deleteOneUser($responseDecoded['id']);
    }

    /**
     * @group func
     * @group funcUser
     * @group crudUser
     */
    public function testGetOneUser(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET,
            '/api/users/'.$this->user->getId(),
            '',
            [],
            true,
            $this->getLoginInformation($this->user->getEmail(), $this->user->getPassword())
        );

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    /**
     * @group func
     * @group funcUser
     * @group crudUser
     */
    public function testPatchUser(): void
    {
        $newRandomEmail = $this->getRandomEmail();
        $jsonPayload = $this->getCustomPayload($newRandomEmail, $this->user->getEmail());
        $response = $this->getResponseFromRequest(
            Request::METHOD_PATCH,
            '/api/users/'.$this->user->getId(),
            $jsonPayload,
            [],
            true,
            $this->getLoginInformation($this->user->getEmail(), $this->user->getPassword())
        );

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent, true);

        $emailUpdate = $responseDecoded['email'];

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals($emailUpdate, $newRandomEmail);
        self::assertNotEquals($emailUpdate, $this->user->getEmail());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    /**
     * @group func
     * @group funcUser
     * @group crudUser
     * @group justHim
     */
    public function testPutUser(): void
    {
        $newRandomEmail = $this->getRandomEmail();
        $jsonPayload = $this->getCustomPayload($newRandomEmail, $this->user->getEmail());

        $response = $this->getResponseFromRequest(
            Request::METHOD_PUT,
            '/api/users/'.$this->user->getId(),
            $jsonPayload,
            [],
            true,
            $this->getLoginInformation($this->user->getEmail(), $this->user->getPassword())
        );

        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent, true);

        $emailUpdate = $responseDecoded['email'];

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals($emailUpdate, $newRandomEmail);
        self::assertNotEquals($emailUpdate, $this->user->getEmail());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    /**
     * @group func
     * @group funcUser
     * @group crudUser
     */
    public function testDeleteUser(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_DELETE,
            '/api/users/'.$this->user->getId(),
            '',
            [],
            true,
            $this->getLoginInformation($this->user->getEmail(), $this->user->getPassword())
        );
        self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}
