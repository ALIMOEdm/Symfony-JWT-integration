<?php
namespace AuthenticationBundle\Api;

/**
 * Class ApiProblemException
 * @package AuthenticationBundle\Api
 */
class ApiProblemException
{
    /**
     * @var ApiProblem
     */
    protected $apiProblem;

    /**
     * @param ApiProblem $apiProblem
     */
    public function __construct(ApiProblem $apiProblem)
    {
        $this->apiProblem = $apiProblem;
    }

    /**
     * @return ApiProblem
     */
    public function getApiProblem()
    {
        return $this->apiProblem;
    }
}