<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 01/12/2017
 * Time: 15:36
 */

namespace UserBundle\Security;

use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use KnpU\OAuth2ClientBundle\Client\Provider\GoogleClient;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use UserBundle\Entity\User;
use Symfony\Component\Security\Core\Security;

class GoogleAuthenticator extends SocialAuthenticator
{
    private $clientRegistry;
    private $em;
    private $router;

    public function __construct(ClientRegistry $clientRegistry, EntityManager $em, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/connect/google/check'){
            //don't auth
            return;
        }

        return $this->fetchAccessToken($this->getGoogleClient());
    }

    public function getGoogleClient()
    {
        return $this->clientRegistry
            ->getClient('google_main');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        $url = $this->router->generate('login');

        return new RedirectResponse($url);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $url = $this->router->generate('nao_homepage');
        return new RedirectResponse($url);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // TODO: Implement start() method.
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // google user
        $googleUser = $this->getGoogleClient()
            ->fetchUserFromToken($credentials);

        $email = $googleUser->getEmail();

        //1 check if they have logged before with google
        $existingUser = $this->em->getRepository('UserBundle:User')
            ->findOneBy(['googleID' => $googleUser->getId()]);
        if ($existingUser) {
            return $existingUser;
        }

        //2 do we have a matching user
        $user = $this->em->getRepository('UserBundle:User')
            ->findOneBy(['email' => $email]);
        if ($user){
            //add google id to existing user and save
            $user->setGoogleID($googleUser->getId());
            $this->em->persist($user);
            $this->em->flush();
        } else {
            //no matching user with email, so must be a new one
            $user = new User();
            $user->setGoogleID($googleUser->getId());
            $user->setEmail($googleUser->getEmail());
            $user->setLogin($googleUser->getName());
            $user->setDateJoined(new \DateTime());
            $role = $this->em->getRepository('UserBundle:Role')->findOneBy(['currentName' => 'Membre']);
            $userStatus = $this->em->getRepository('UserBundle:UserStatus')->findOneBy(['name' => 'Actif']);
            $user->setRole($role);
            $user->setUserStatus($userStatus);
            $user->setPlainPassword('motdepasse');
            $user->setMdp($user->getSalt());
            $user->setPlainPassword('tot');
            $badge = $this->em->getRepository('UserBundle:Badge')->findOneByName('Nouveau membre');
            $user->addBadge($badge);
            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }
}