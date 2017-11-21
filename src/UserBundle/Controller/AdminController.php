<?php

namespace UserBundle\Controller;

use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use UserBundle\Form\ProfileType;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function profilAction(Request $request)
    {
        $loggedUser = $this->getUser();
        $form = $this->createForm(ProfileType::class, $loggedUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if ($loggedUser->getPlainPassword() != '')
            {
                //password change we need to encode it
                $encoder = $this->get('security.password_encoder');
                $password = $encoder->encodePassword($loggedUser, $loggedUser->getPlainPassword());
                $loggedUser->setMdp($password);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('UserBundle:Admin:profil.html.twig',[
            'form' => $form->createView(),
            'avatar' => $loggedUser->getAvatar()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function badgeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // SPEND HOURS Trying to find of doing this with dql. In the end I gave up!!!
        $userId = $this->getUser()->getId();
        $sql = "SELECT * FROM(SELECT b1.id as id, b1.name as badge, b1.image as pic, b1.description as myDesc,"
            . " r1.user_id FROM badges as b1 INNER JOIN rewards as r1 ON b1.id = r1.badge_id"
            ." WHERE r1.user_id = :user_id"
            . " UNION SELECT b2.id, b2.name, b2.image, b2.description, NULL FROM badges as b2) as tmp "
            . " GROUP BY id, badge, pic, myDesc ORDER BY id ASC";


        $stmt = $em->getConnection()->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $badges = $stmt->fetchAll();
        return $this->render('UserBundle:Admin:badge.html.twig', [
            'badges' => $badges,
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function gestionUserAction(Request $request)
    {
        return $this->render('UserBundle:Admin:gestion_user.html.twig', [
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }
}
