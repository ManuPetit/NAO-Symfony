<?php

namespace NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Tools\Pagination\Paginator;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NAOBundle:index:index.html.twig');
    }

    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('NAOBundle:Observation')->getLastObservations();
        $posts = $em->getRepository('BlogBundle:Post')->getLastPosts();
        return $this->render('NAOBundle:Default:home.html.twig', array(
            'observations' => $observations,
            'posts'        => $posts
        ));
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
