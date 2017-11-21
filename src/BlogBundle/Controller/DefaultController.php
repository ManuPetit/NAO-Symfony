<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($id = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('BlogBundle:Post')->getLastPosts();
        return $this->render('BlogBundle:index:index.html.twig', array(
            'posts' => $posts
        ));
    }
}
