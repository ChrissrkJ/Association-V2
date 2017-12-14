<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

/*
*@Route('/admin/volunteer)
*
*/
class UserController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:User:index.html.twig', array(
            // ...
        ));
    }



    /**
     * @Route("/list", name="user_list")
     */
    public function listAction()
    {
      $users = $this->getDoctrine()
      ->getRepository(User::class)
      ->findAll();

      return $this->render('AppBundle:User:list.html.twig', array(
          'users' => $users,
      ));
    }
    /**
     * @Route("/registration", name="user_register")
     */
    public function registrationAction(Request $r)
    {
      $user = new User();
      $form = $this->createForm('AppBundle\Form\UserType');
      $form->handleRequest($r);

      if ($form->isSubmitted() && $form->isValid()) {
        $user = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

          return $this->redirectToRoute('user_list');
      }

        return $this->render('AppBundle:User:registration.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/update/{id}", name="user_update")
     */
    public function updateAction(Request $r, $id)
    {
      $user = $this->getDoctrine()
      ->getRepository(User::class)
      ->find($id);

      $form = $this->createForm('AppBundle\Form\UserType', $user);
      $form->handleRequest($r);

      if ($form->isSubmitted() && $form->isValid()) {
        $um = $this->get('fos_user.user_manager');
        $um->updateUser($user);
        return $this->redirectToRoute('user_list');
      }
        return $this->render('AppBundle:User:update.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/profile")
     */
    public function profileAction()
    {
      $user = $this->getDoctrine()
      ->getRepository(User::class)
      ->find($id);

        return $this->render('AppBundle:User:profile.html.twig', array(
            'user' =>$user
        ));
    }

    /**
     * @Route("/delete/{id}", name="user_delete")
     */
    public function deleteAction($id)
    {
      $user = $this->getDoctrine()
      ->getRepository(User::class)
      ->find($id);

      $um = $this->get('fos_user.user_manager');
      $um->deleteUser($user);

        return $this->render('AppBundle:User:delete.html.twig', array(
            // ...
        ));
    }

}
