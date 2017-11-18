<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 17/11/2017
 * Time: 13:57
 */

namespace UserBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Security;

class FormLoginAuthenticator extends AbstractFormLoginAuthenticator
{
    private $router;
    private $encoder;

    public function __construct(RouterInterface $router, UserPasswordEncoderInterface $encoder)
    {
        $this->router = $router;
        $this->encoder = $encoder;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }

    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/login_check'){
            return;
        }

        $email = $request->request->get('_email');
        $request->getSession()->set(Security::LAST_USERNAME, $email);
        $password = $request->request->get('_password');

        return [
            'email' => $email,
            'password' => $password
        ];

    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $email = $credentials['email'];

        return $userProvider->loadUserByUsername($email);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $plainPassword = $credentials['password'];
        if ($this->encoder->isPasswordValid($user, $plainPassword)){
            return true;
        }

        throw new BadCredentialsException('Mot de passe ou email inconnu.');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        $url = $this->router->generate('login');

        return new RedirectResponse($url);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return parent::onAuthenticationSuccess($request, $token, $providerKey); // TODO: Change the autogenerated stub
    }

    public function supportsRememberMe()
    {
        return false;
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('user_profile');
    }
}