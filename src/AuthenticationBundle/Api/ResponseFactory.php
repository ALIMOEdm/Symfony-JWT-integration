<?php
namespace AuthenticationBundle\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ResponseFactory
 * @package AuthenticationBundle\Api
 */
class ResponseFactory
{
    public function createResponse(ApiProblem $apiProblem)
    {
        $data = $apiProblem->toArray();

        $response = new JsonResponse(
            $data,
            $apiProblem->getStatusCode()
        );

        $response->headers->set('Content-Type', 'application/problem+json');

        return $response;
    }
}