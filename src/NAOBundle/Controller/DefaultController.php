<?php

namespace NAOBundle\Controller;

use NAOBundle\Entity\Bird;
use NAOBundle\Entity\Observation;
use NAOBundle\Form\BirdSearchType;
use NAOBundle\Form\BirdType;
use NAOBundle\Form\ObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NAOBundle:index:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        return $this->render('NAOBundle:about:about.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function participateAction(Request $request)
    {
        $currentUser = $this->getUser();
        $testObs = $this->getDoctrine()->getManager()->getRepository('NAOBundle:MainStatus');
        $observation = new Observation();
        $observation->setMainStatus($testObs->find(2));
        $observation->setUser($currentUser);
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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(BirdSearchType::class);
        {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $frenchName = $form->getData()->getBird()->getFrenchName();
                $listBirds = $em->getRepository('NAOBundle:Observation')->searchObs($frenchName);
                return $this->render('NAOBundle:search:search.Html.twig', array(
                    'form' => $form->createView(),
                    'listBirds' => $listBirds
                ));
            }
        }
        return $this->render('NAOBundle:search:search.Html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction()
    {
        return $this->render('NAOBundle:contact:contact.Html.twig');
    }
}
