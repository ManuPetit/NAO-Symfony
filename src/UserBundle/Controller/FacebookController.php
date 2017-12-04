<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class FacebookController extends Controller
{


    public function connectAction()
    {
        //will redirect to facebook
        return $this->get('oauth2.registry')
            ->getClient('facebook_main')
            ->redirect();
    }

    public function connectCheckAction(Request $request)
    {

    }
}
