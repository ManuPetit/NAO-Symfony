<?php

namespace UserBundle\Controller;

use NAOBundle\Entity\MainStatus;
use NAOBundle\Entity\Observation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

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
     * @param null $status
     * @return Response
     */
    public function gestionObservationsAction(Request $request)
    {
        //get the requested data
        $filter = $request->query->get('filter');
        $search = $request->query->get('search');
        //retrouver toutes les observations
        $em = $this->getDoctrine()->getManager();
        if (isset($filter)) {
            //on a un status, donc on va retrouver toutes les observations avec ce status
            $observations = $em->getRepository('NAOBundle:Observation')->getAllObservations($filter);
        } elseif (isset($search)){
            //on a un mot à chercher
            $observations = $em->getRepository('NAOBundle:Observation')->getObservationBySearch($search);
        } else {
            //pas de status, on retrouve toutes les observations
            $observations = $em->getRepository('NAOBundle:Observation')->getAllObservations();
        }
        //on retrouve la liste des status pour filtrer
        $filterStatus = $em->getRepository('NAOBundle:MainStatus')->getObsFilterMainStatus();
        //on retrouve la liste des status pour changer
        $applyFilter = $em->getRepository('NAOBundle:MainStatus')->getObsFilterToApply();
        return $this->render('UserBundle:Observations:gestion_observations.html.twig', [
            'statusToFilter' => $filterStatus,
            'statusToApply' => $applyFilter,
            'observations' => $observations,
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }

    /**
     * @param Observation $observation
     * @param $value
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_PRO')")
     */
    public function updateObservationStatusAction(Observation $observation, $value)
    {
        //change le status d'une observation
        $em = $this->getDoctrine()->getManager();
        $oldStatus = $observation->getMainStatus();
        $mainStatus = $em->getRepository('NAOBundle:MainStatus')->find($value);
        //verifier que les status sont différents
        if ($oldStatus != $mainStatus) {
            $observation->setMainStatus($mainStatus);
            $em->flush();
            if ($mainStatus->getId() == 5) {
                //on a supprimé l'observations
                $message = "Suppression confirmée de l'observation : " . $observation->getTitle();
            } else {
                //on a changé le status
                $message = "Changement de status de publication pour l'observation : " . $observation->getTitle()
                    . "<br>Ancien status : " . $oldStatus->getName() . "<br>Nouveau status : "
                    . $mainStatus->getName() .".";
            }
            $this->addFlash('info', $message);
        }

        return new Response();
    }

}
