<?php

namespace NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NAOBundle:index:index.html.twig');
    }

    public function homeAction()
    {
        return $this->render('NAOBundle:home:home.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('NAOBundle:about:about.html.twig');
    }

    public function observationAction()
    {
        return $this->render('NAOBundle:observation:observation.html.twig');
    }

    public function participateAction()
    {
        return $this->render('NAOBundle:participate:participate.html.twig');
    }

    public function searchAction()
    {
        return $this->render('NAOBundle:search:search.Html.twig');
    }

    public function contactAction()
    {
        return $this->render('NAOBundle:contact:contact.Html.twig');
    }
}
