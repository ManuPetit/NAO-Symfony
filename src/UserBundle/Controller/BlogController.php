<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class BlogController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function articleAction(Request $request)
    {
        return $this->render('UserBundle:Blog:article.html.twig', [
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function gestionArticlesAction(Request $request)
    {
        return $this->render('UserBundle:Blog:gestion_article.html.twig', [
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }
}
