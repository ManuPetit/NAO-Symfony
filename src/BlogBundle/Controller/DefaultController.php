<?php

namespace BlogBundle\Controller;


use BlogBundle\Form\SearchType;
use BlogBundle\Entity\Post;
use BlogBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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

        $posts = $em->getRepository('BlogBundle:Post')->getLastPosts();
        return $this->render('BlogBundle:index:index.html.twig', array(
            'posts' => $posts
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function articleAction(Request $request)
    {
        $article = new Post();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            //set user and status
            $article->setUser($this->getUser());
            $status = $form->get('post')->isClicked() ? 3 : 1;
            $article->setMainStatus($em->getRepository('NAOBundle:MainStatus')->find($status));
            //sort out the photo
            $blogImages = $article->getBlogImages();
            foreach ($blogImages as $blogImage)
            {
                $blogImage->setPost($article);
                $blogImage->upload();
            }
            //update the date
            $article->setDate(new \DateTime());
            //save the data
            $em->persist($article);
            $em->flush();
            $message = "Article enregistré en tant que brouillon.";
            if ($status == 3) {
                $message = "Article enregistré et publié sur le blog du site.";
            }
            $this->addFlash('info', $message);
            return $this->redirectToRoute('user_gestion_article');
        }

        return $this->render('BlogBundle:Default:article.html.twig', [
            'avatar' => $this->getUser()->getAvatar(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function articleUpdateAction(Request $request, Post $post)
    {
        $form = $this->createForm(ArticleType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            //set user and status
            $post->setUser($this->getUser());
            $status = $form->get('post')->isClicked() ? 3 : 1;
            $post->setMainStatus($em->getRepository('NAOBundle:MainStatus')->find($status));
            //sort out the photo
            $blogImages = $post->getBlogImages();
            foreach ($blogImages as $blogImage)
            {
                $blogImage->setPost($post);
                $blogImage->upload();
            }
            //update the date
            $post->setDate(new \DateTime());
            //save the data
            $em->persist($post);
            $em->flush();
            $message = "Article enregistré en tant que brouillon.";
            if ($status == 3) {
                $message = "Article enregistré et publié sur le blog du site.";
            }
            $this->addFlash('info', $message);
            return $this->redirectToRoute('user_gestion_article');
        }

        return $this->render('BlogBundle:Default:article.html.twig', [
            'avatar' => $this->getUser()->getAvatar(),
            'form' => $form->createView()
        ]);
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function gestionArticlesAction(Request $request)
    {//get the requested data
        $filter = $request->query->get('filter');
        $search = $request->query->get('search');
        $em = $this->getDoctrine()->getManager();
        if (isset($filter)) {
            $articles = $em->getRepository('BlogBundle:Post')->getAllPosts($filter);
        } elseif (isset($search)) {
            $articles = $em->getRepository('BlogBundle:Post')->getAllPostBySearch($search);
        } else {
            $articles = $em->getRepository('BlogBundle:Post')->getAllPosts();
        }
        $filterStatus = $em->getRepository('NAOBundle:MainStatus')->getPostFilterMainStatus();
        return $this->render('BlogBundle:Default:gestion_article.html.twig', [
            'articles' => $articles,
            'filters' => $filterStatus,
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_PRO')")
     */
    public function deleteArticleAction(Request $request, Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        //set status to supprimé
        $status = $em->getRepository('NAOBundle:MainStatus')->findOneByName('Supprimé');
        $post->setMainStatus($status);
        $em->flush();
        $message = "L'article : &ldquo;" . $post->getTitle() . "&rdquo; a bien été supprimé.";
        $this->addFlash('info', $message);
        return $this->redirectToRoute('user_gestion_article');
    }

    /**
     * @param Post $post
     * @param $status
     * @return Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function updateArticleStatusAction(Post $post, $status)
    {
        $em = $this->getDoctrine()->getManager();
        $oldStatus = $post->getMainStatus();
        $newStatus = $em->getRepository('NAOBundle:MainStatus')->find($status);
        if ($oldStatus != $newStatus) {
            $post->setMainStatus($newStatus);
            //changing the date also
            $post->setDate(new \DateTime());
            $em->flush();
            $message = "Changement de status de publication pour l'article : " . $post->getTitle()
                . "<br>Ancien status : " . $oldStatus->getName() . " - Nouveau status : "
                . $newStatus->getName() .".";
            $this->addFlash('info', $message);
        }

        return new Response();
    }

}
