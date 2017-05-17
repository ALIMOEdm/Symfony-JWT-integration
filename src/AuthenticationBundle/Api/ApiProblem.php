<?php
namespace AuthenticationBundle\Api;

/**
 * Class ApiProblem
 * @package AuthenticationBundle\Api
 */
class ApiProblem
{
    /**
     * @var int
     */
    protected $httpCode;

    /**
     * @var string
     */
    protected $problemType = '';

    /**
     * @var string
     */
    protected $problemMessage = '';

    /**
     * @param int $httpCode
     */
    public function __construct($httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->httpCode;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function set($key, $value)
    {
        $this->problemType = $key;
        $this->problemMessage = $value;
    }

    /**
     * Convert instance to array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'statusCode' => $this->httpCode,
            $this->problemType => $this->problemMessage,
        ];
    }
}