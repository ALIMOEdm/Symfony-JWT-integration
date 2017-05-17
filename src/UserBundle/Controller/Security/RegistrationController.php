<?php
namespace UserBundle\Controller\Security;


use AppBundle\Controller\V1\BaseApiController;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegistrationController extends BaseApiController
{

    /**
     * @Route("/register")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function registerAction(Request $request)
    {
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        /** @var User $user */
        $user = $userManager->createUser();
        $user->setEnabled(true);

        /** @var Form $form */
        $form = $this->createForm(RegistrationType::class, $user);

        $form->submit($request->request->all());
        if ($form->isValid()) {
            $user->setUsername($user->getEmail());
            $user->addRole('ROLE_CLIENT');
            $userManager->updateUser($user);

//            /** @var MailerInterface $mailer */
//            $mailer = $this->get(UserBundleServices::MAILER);
//            $mailer->sendPassword($user, $password);

            return new JsonResponse(null, 204);
        }

        return new JsonResponse([
            'status' => 'error',
            'errors' => $this->normalizeFormErrors($form),
        ], 400);
    }

    public function normalizeFormErrors(Form $form)
    {
        $errors = [];
        foreach ($form as $fieldName => $formField) {
            // each field has an array of errors
            foreach ($formField->getErrors() as $error) {
                $errors[] = [
                    'name' => $fieldName,
                    'description' => $error->getMessage(),
                ];
            }
        }

        foreach ($form->getErrors() as $error) {
            $errors[] = [
                'name' => 'form',
                'description' => $error->getMessage(),
            ];
        }

        return $errors;
    }
}