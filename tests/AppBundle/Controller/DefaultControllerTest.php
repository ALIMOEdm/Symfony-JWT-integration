<?php

namespace Tests\AppBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Psr7\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = new Client([
            'base_uri' => 'http://amps-local.com',
        ]);

        try {
            /** @var Response $response */
            $response = $client->request('POST', '/app_dev.php/security/token/create', [
                'form_params' => [
                    'email' => 'test@sibers.com',
                    'password' => '11111',
                ]
            ]);

            $res = $response->getBody()->getContents();

            $result = json_decode($res, true);

            $token = $result['token'];

            $response = $client->request('GET', '/app_dev.php/api/v1/test', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ]
            ]);

            var_dump($response->getBody()->getContents());
        } catch (\Exception $e) {
            echo ($e->getMessage());
        }

        die;
    }

    public function testRegistration()
    {
        $client = new Client([
            'base_uri' => 'http://amps-local.com',
        ]);

        try {
            /** @var Response $response */
            $response = $client->request('POST', '/app_dev.php/security/register', [
                'form_params' => [
                    'email' => 'test3@sibers.com',
                    'password' => '11111',
                ]
            ]);

            $res = $response->getBody()->getContents();

            var_dump($res);
        } catch (\Exception $e) {
            echo ($e->getMessage());
        }

        die;
    }
}
