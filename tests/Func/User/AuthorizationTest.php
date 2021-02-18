<?php

declare(strict_types=1);

namespace App\Tests\Func\User;

use App\Tests\Func\User\Utils\SetUpUser;
use App\Tests\Func\User\Utils\TearDownUser;
use App\Tests\Func\User\Utils\UserAbstract;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationTest extends UserAbstract
{
    use SetUpUser;
    use TearDownUser;

    /**
     * @group func
     * @group funcUser
     * @group authorizationUser
     */
    public function testPutCurrentUserNotConnected(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_PUT,
            '/api/users/'.$this->user->getId(),
            $this->getRandomPayload()
        );
        $responseContent = $response->getContent();

        $responseDecoded = json_decode($responseContent);
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    /**
     * @group func
     * @group funcUser
     * @group authorizationUser
     */
    public function testPatchCurrentUserNotConnected(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_PATCH,
            '/api/users/'.$this->user->getId(),
            $this->getRandomPayload()
        );
        $responseContent = $response->getContent();

        $responseDecoded = json_decode($responseContent);
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    /**
     * @group func
     * @group funcUser
     * @group authorizationUser
     */
    public function testDeleteCurrentUserNotConnected(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_DELETE,
            '/api/users/'.$this->user->getId()
        );
        $responseContent = $response->getContent();

        $responseDecoded = json_decode($responseContent);
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    /**
     * @group func
     * @group funcUser
     * @group authorizationUser
     */
    public function testDeleteARandomUser(): void
    {
        /* Creation of a random user */
        $randomUser = $this->createRandomUser();

        /* Trying to delete this random user */
        $response = $this->getResponseFromRequest(
            Request::METHOD_DELETE,
            '/api/users/'.$randomUser->getId(),
            '',
            [],
            true,
            $this->getLoginInformation($this->user->getEmail(), $this->user->getPassword())
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent, true);

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
        self::assertEquals($this->accessDenied, $responseDecoded['message']);

        /* Clearing the DB, deleting the random user */
        $this->deleteOneUser($randomUser->getId());
    }
}
