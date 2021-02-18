<?php

namespace App\Tests\Func;

use App\DataFixtures\AppFixtures;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractEndPoint extends WebTestCase
{
    use SymfonyComponent;
    protected array $serverInformation = ['ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'];
    protected string $tokenNotFound = 'JWT Token not found';
    protected string $accessDenied = 'Access Denied.';
    protected string $loginPayload = '{"username": "%s", "password": "%s"}';

    public function getResponseFromRequest(
        string $method,
        string $uri,
        string $payload = '',
        array $parameters = [],
        bool $withAuthentication = false,
        array $loginInformation = []
    ): Response {
        $client = $this->createAuthenticationClient($withAuthentication, $loginInformation);

        $client->request(
            $method,
            $uri,
            $parameters,
            [],
            $this->serverInformation,
            $payload
        );

        return $client->getResponse();
    }

    protected function createAuthenticationClient(bool $withAuthentication, array $loginInformation): KernelBrowser
    {
        self::getKernel();
        if (!$withAuthentication) {
            return self::$kernelBrowser;
        }
        if ([] !== $loginInformation) {
            self::$kernelBrowser->request(
                Request::METHOD_POST,
                '/api/login',
                [],
                [],
                $this->serverInformation,
                sprintf($this->loginPayload, $loginInformation['email'], $loginInformation['password'])
            );
        } else {
            self::$kernelBrowser->request(
                Request::METHOD_POST,
                '/api/login',
                [],
                [],
                $this->serverInformation,
                sprintf($this->loginPayload, AppFixtures::DEFAULT_USER['email'], AppFixtures::DEFAULT_USER['password'])
            );
        }

        $data = json_decode(self::$kernelBrowser->getResponse()->getContent(), true);
        self::$kernelBrowser->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return self::$kernelBrowser;
    }
}
