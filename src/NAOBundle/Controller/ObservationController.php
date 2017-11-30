<?php

namespace NAOBundle\Controller;

use NAOBundle\Entity\Bird;
use NAOBundle\Entity\Observation;
use NAOBundle\Form\BirdType;
use NAOBundle\Form\ObservationType;
use NAOBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ObservationController extends Controller
{
    public function observationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('NAOBundle:Observation')->getLastObservations();
        return $this->render('NAOBundle:observation:observation.html.twig',array(
            'observation'  => $observations
        ));
    }

    public function show_moreAction($first)
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('NAOBundle:Observation')->getLastObservations($first, 4);
        return $this->render('NAOBundle:observation:show_more.html.twig',array(
            'observation'  => $observations
        ));
    }

    public function show_allAction()
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('NAOBundle:Observation')->getLastObservations(8, 100);
        return $this->render('NAOBundle:observation:show_more.html.twig',array(
            'observation'  => $observations
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = $em->getRepository('NAOBundle:Observation')->find($id);
        return $this->render('NAOBundle:observation:show.html.twig',array(
            'observation'  => $observation
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function saveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $obs = $em->getRepository('NAOBundle:Observation')->find($id);
        $user = $this->getUser();
        $user->addFavoriteObservation($obs);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('nao_observation');
    }


}