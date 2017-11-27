<?php

namespace UserBundle\Controller;

use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
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

        if ($form->isSubmitted() && $form->isValid()) {
            if ($loggedUser->getPlainPassword() != '') {
                //password change we need to encode it
                $encoder = $this->get('security.password_encoder');
                $password = $encoder->encodePassword($loggedUser, $loggedUser->getPlainPassword());
                $loggedUser->setMdp($password);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('UserBundle:Admin:profil.html.twig', [
            'form' => $form->createView(),
            'avatar' => $loggedUser->getAvatar()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function badgeAction()
    {
        $em = $this->getDoctrine()->getManager();
        // SPEND HOURS Trying to find of doing this with dql. In the end I gave up!!!
        $userId = $this->getUser()->getId();
        $sql = "SELECT * FROM(SELECT b1.id as id, b1.name as badge, b1.image as pic, b1.description as myDesc,"
            . " r1.user_id FROM badges as b1 INNER JOIN rewards as r1 ON b1.id = r1.badge_id"
            . " WHERE r1.user_id = :user_id"
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
        //check if data in request
        $filter = $request->query->get('filter');
        $search = $request->query->get('search');
        $em = $this->getDoctrine()->getManager();
        //get appropriate users
        if (isset($filter)) {
            $users = $em->getRepository('UserBundle:User')->getAllValidUsers($this->getUser(), $filter);
        } elseif (isset($search)) {
            $users = $em->getRepository('UserBundle:User')->getAllValidUsersBySearch($this->getUser(), $search);
        } else {
            $users = $em->getRepository('UserBundle:User')->getAllValidUsers($this->getUser());
        }
        $status = $em->getRepository('UserBundle:UserStatus')->findAll();
        $roles = $em->getRepository('UserBundle:Role')->findAll();

        return $this->render('UserBundle:Admin:gestion_user.html.twig', [
            'status' => $status,
            'roles' => $roles,
            'users' => $users,
            'avatar' => $this->getUser()->getAvatar()
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateUserRoleAction(Request $request, User $user, $role)
    {
        $em = $this->getDoctrine()->getManager();
        $oldRole = $user->getRole();
        $newRole = $em->getRepository('UserBundle:Role')->find($role);
        $user->setRole($newRole);
        $em->flush();
        $message = "Changement du rôle de " . ucfirst($user->getLogin()) . "<br>"
            . "Ancien rôle : " . $oldRole->getCurrentName() . " - Nouveau rôle : " . $newRole->getCurrentName();
        $this->addFlash('info', $message);
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateUserStatusAction(Request $request, User $user, $status)
    {
        $em = $this->getDoctrine()->getManager();
        $oldStatus = $user->getUserStatus();
        $newStatus = $em->getRepository('UserBundle:UserStatus')->find($status);
        //amend user status
        $user->setUserStatus($newStatus);
        $em->flush();
        if ($status == 3) {
            $message = "L'utilisateur " . ucfirst($user->getLogin()) . " a été supprimé.";
        } else {
            $message = "Changement de status de l'utilisateur " . ucfirst($user->getLogin()) . "<br>"
                . "Ancien status : " . $oldStatus->getName() . " - Nouveau status : " . $newStatus->getName();
        }
        $this->addFlash('info', $message);

        return new Response();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_MEMBRE')")
     */
    public function userUploadAvatarAction(Request $request)
    {
        //retrieve the extension of the file
        $targetDirectory = 'img/avatars/';
        $imageFileType = pathinfo(basename($_FILES['avatar']['name']), PATHINFO_EXTENSION);
        $newImageName = $this->generateFileName() . '.' . $imageFileType;
        $targetFile = $targetDirectory . $newImageName;
        //check if image
        $errors = [];
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if ($check === false) {
            $errors[] = "ce fichier n'est pas une image.";
        }
        // Check file size 5Mb
        if ($_FILES["avatar"]["size"] > 3000000) {
            $errors[] = "ce fichier est trop volumineux.";
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $errors[] = "uniquement des fichiers de type JPG, JPEG, PNG & GIF.";
        }
        if (empty($errors)) {
            // upload file and change user image profil
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                $message = "L'image " . basename($_FILES["avatar"]["name"]) . " a bien été mise en place comme image de profil.";
                //update the user picture
                $em = $this->getDoctrine()->getManager();
                $user = $this->getUser();
                $user->setAvatar($newImageName);
                $em->flush();
            } else {
                $errors[] = "une erreur s'est produite lors du téléchargement du fichier.";
            }
        }
        if (empty($errors)) {
            $this->addFlash('info', $message);
        } else {
            if (count($errors) > 1) {
                $message = "Plusieurs erreurs se sont produites :<br>";
            } else {
                $message = "Une erreur s'est produite :<br>";
            }
            foreach ($errors as $error) {
                $message .= " - " . $error . "<br>";
            }
            $this->addFlash('danger', $message);
        }
        return $this->redirectToRoute('user_profile');
    }

    private function generateFileName(){
        //generate random 8 letters word
        $letter = array_merge(range('a', 'z'), range('A', 'Z'), range(0,9));
        shuffle($letter);
        $word = substr(implode($letter), 0, 15);
        return date('Ymd_His') . $word;
    }
}
