<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostsController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * Get old posts from DB
     * Delete with v1
     */
    public function show_old_postsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('BlogBundle:Post')->getLastPosts(0, 3, 'ASC');
        return $this->render('BlogBundle:index:index.html.twig', array(
            'posts' => $posts,
            'index' => 0
        ));
    }

    /**
     * @param $first : set the offset of results returned
     * @param $limit : set the limit of results returned
     * @param $order : order of results returned
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show_more_postsAction($first, $limit, $order)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('BlogBundle:Post')->getLastPosts($first, $limit, $order);
        return $this->render('BlogBundle:index:show_more.html.twig', array(
            'posts' => $posts,
            'index' => 3
        ));
    }

    /**
     * @param $id : selected post id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show_postAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('BlogBundle:Post')->find($id);
        return $this->render('BlogBundle:index:show_post.html.twig', array(
            'post' => $post,
        ));
    }
}