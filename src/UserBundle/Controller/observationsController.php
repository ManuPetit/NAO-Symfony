<?php

namespace UserBundle\Controller;

use NAOBundle\Entity\Observation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class observationsController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function observationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('NAOBundle:Observation')
            ->getObservationsPerUser($this->getUser());


        return $this->render('UserBundle:Observations:observations.html.twig', [
            'observations' => $observations,
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }

    /**
     * @param Observation $observation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function deleteObservationAction(Observation $observation)
    {
        //get "Supprimé" status
        $em = $this->getDoctrine()->getManager();
        $status = $em->getRepository('NAOBundle:MainStatus')->findOneByName('Supprimé');
        $observation->setMainStatus($status);
        $em->flush();
        $this->addFlash('info', 'Observation supprimée.');
        return $this->redirectToRoute('user_observation');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function favorisAction(Request $request)
    {
        $favoris = $this->getUser()->getFavoriteObservations();
        return $this->render('UserBundle:Observations:favoris.html.twig', [
            'favoris' => $favoris,
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }

    /**
     * @param Observation $observation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function deleteFavorisAction(Observation $observation)
    {
        //remove observation from collection
        $em = $this->getDoctrine()->getManager();
        $this->getUser()->removeFavoriteObservation($observation);
        $em->flush();
        $this->addFlash('info', 'Observation supprimée de vos favoris.');
        return $this->redirectToRoute('user_favoris');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function gestionObservationsAction(Request $request)
    {
        //retrouver toutes les observations
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository('NAOBundle:Observation')->getAllObservations();
        dump($observations);
        return $this->render('UserBundle:Observations:gestion_observations.html.twig', [
            'observations' => $observations,
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }
}
