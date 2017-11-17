<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\InscriptionType;
use UserBundle\Entity\Role;

class InscriptionController extends Controller
{
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            //encode the new user password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setMdp($password);
            //set the role
            $em = $this->getDoctrine()->getManager();
            $role = $em->getRepository('UserBundle:Role')->findOneByCurrentName('Membre');
            $user->setRole($role);
            //save data
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render('UserBundle:Inscription:register.html.twig',[
            'form' => $form->createView()
        ]);

    }
}
