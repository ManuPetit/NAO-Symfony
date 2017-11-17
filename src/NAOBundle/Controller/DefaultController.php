<?php

namespace NAOBundle\Controller;

use NAOBundle\Entity\Observation;
use NAOBundle\Form\ObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        return $this->render('NAOBundle:home:home.html.twig', array(
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

    public function participateAction(Request $request)
    {
        $observation = new Observation();
        $form = $this->get('form.factory')->create(ObservationType::class, $observation);
        if ($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()){
                $observation->getPhotos();
                var_dump($observation->getPhotos([1]));
                $em = $this->getDoctrine()->getManager();
                $em->persist($observation);
                $em->flush();

                $request->getSession()->getFlashbag()->add('info','Observation enregistrée et soumise à validation');
                return $this->redirectToRoute('nao_participate');
            }
        }


        return $this->render('NAOBundle:participate:participate.html.twig', array(
            'form' => $form->createView(),
        ));
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
