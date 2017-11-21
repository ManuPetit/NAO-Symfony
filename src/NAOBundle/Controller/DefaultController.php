<?php

namespace NAOBundle\Controller;

use NAOBundle\Entity\Bird;
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

    public function participateAction(Request $request)
    {
        $testObs = $this->getDoctrine()->getManager()->getRepository('NAOBundle:MainStatus');
        $observation = new Observation();
        $observation->setMainStatus($testObs->find(2));
        $form = $this->get('form.factory')->create(ObservationType::class, $observation);
        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                if ($form->getClickedButton()->getName() === 'saveAndAdd'){
                    $observation->setMainStatus($testObs->find(1));
                }
                $em = $this->getDoctrine()->getManager();
                $photos = $observation->getPhotos();
                foreach ($photos as $photo){
                    $photo->setObservation($observation);
                    $photo->upload();
                }
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
        $em = $this->getDoctrine()->getManager();
        $bird = $em->getRepository('NAOBundle:Bird')->find(2);
        $form = $this->get('form.factory')->create(BirdType::class, $bird);
        return $this->render('NAOBundle:search:search.Html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function contactAction()
    {
        return $this->render('NAOBundle:contact:contact.Html.twig');
    }
}
