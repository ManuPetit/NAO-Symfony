<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        /*//if user already identified redirect to homepage
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            //return $this->redirectToRoute('nao_homepage');
            return $this->redirectToRoute('nao_homepage');

        }*/

        //use authentication service to get username and error in case of
        //previous attempt of login
        $authUtils = $this->get('security.authentication_utils');

        return $this->render('UserBundle:Security:login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ]);
    }

    public function loginCheckAction()
    {

    }

    public function logoutAction()
    {

    }
}
