<?php
namespace AppBundle\Controller\V1;

use AppBundle\Controller\BaseController;
use Symfony\Component\Form\FormInterface;

class BaseApiController extends BaseController
{

    /**
     * Creates and returns a Form instance from the type of the form.
     *
     * @param string $type    The fully qualified class name of the form type.
     * @param mixed  $data    The initial data for the form.
     * @param array  $options Options for the form.
     *
     * @return FormInterface
     */
    protected function createForm($type, $data = null, array $options = [])
    {
        return $this->container->get('form.factory')
            ->create($type, $data, $options);
    }

}