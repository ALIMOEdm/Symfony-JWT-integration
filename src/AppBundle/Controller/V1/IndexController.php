<?php
namespace AppBundle\Controller\V1;

use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends BaseApiController
{
    /**
     * @Route("/test", name="test_api")
     */
    public function index()
    {
        return new JsonResponse(['success' => true]);
    }
}