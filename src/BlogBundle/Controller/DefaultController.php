<?php

namespace BlogBundle\Controller;

use BlogBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('BlogBundle:Post');
        $lastPosts = $posts->getLastPosts();
        $form = $this->get('form.factory')->create(SearchType::class);

            return $this->render('BlogBundle:index:index.html.twig', array(
                'posts' => $lastPosts,
                'index' => 0,
                'form' => $form->createView()
            ));
        }

}
