<?php

namespace Elpiafo\SwitchUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SwitchController extends Controller
{

    public function switchAction($userId)
    {
        $em = $this->getDoctrine()->getManager();

        $currentUser = $this->getUser();
        $grantorUser = $em->getRepository('Symfony\Component\Security\Core\User\UserInterface')->findOneById($userId);
        if (!$grantorUser) {
            throw $this->createNotFoundException('Requested user not found');
        }
        if (!$em->getRepository('ElpiafoSwitchUserBundle:SwitchUser')->isAllowed($userId, $currentUser->getId())) {
            throw $this->createAccessDeniedException('Requested user has not granted current account');
        }
        $this->switchUser($grantorUser, null, $this->get('security.token_storage')->getToken()->getProviderKey(), $grantorUser->getRoles());
        return $this->switchSuccessRedirect();
    }

    protected function switchSuccessRedirect()
    {
        return $this->redirect('/');
    }

    protected function switchUser($user, $credentials, $providerKey, array $roles)
    {
        $token = new UsernamePasswordToken(
            $user,
            $credentials,
            $providerKey,
            $roles
        );
        $this->container->get('security.token_storage')->setToken($token);
    }
}