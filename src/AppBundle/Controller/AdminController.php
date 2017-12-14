<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Admin;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/supadmin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/index", name="admin_index")
     */
    public function indexAction()
    {


      return $this->render('AppBundle:Admin:index.html.twig', array(

      ));
    }

    /**
     * @Route("/list", name="admin_list")
     */
    public function listAction()
    {
      // $admins = $this->getDoctrine()
      // ->getRepository(Admin::class)
      // ->findAll();
      $userManager = $this->get('fos_user.user_manager');
      $admins = $userManager->findUsers();

      return $this->render('AppBundle:Admin:list.html.twig', array(
          'admins' => $admins,
      ));
    }

    /**
     * @Route("/registration", name="admin_register")
     */
    public function registrationAction(Request $r)
    {
        $admin = new Admin();

        $form = $this->createForm('AppBundle\Form\AdminType');
        $form->handleRequest($r);

        if ($form->isSubmitted() && $form->isValid()) {
          $admin = $form->getData();

          $em = $this->getDoctrine()->getManager();
          $em->persist($admin);
          $em->flush();

            return $this->redirectToRoute('admin_list');
        }

        return $this->render('AppBundle:Admin:registration.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/profile/{id}", name="admin_profile")
     */
    public function profileAction($id)
    {
      $admin = $this->getDoctrine()
      ->getRepository(Admin::class)
      ->find($id);

        return $this->render('AppBundle:Admin:profile.html.twig', array(
            'admin' =>$admin
        ));
    }

    /**
     * @Route("/update/{id}", name="admin_update")
     */
    public function updateAction(Request $r, $id)
    {
      $admin = $this->getDoctrine()
      ->getRepository(Admin::class)
      ->find($id);

      $form = $this->createForm('AppBundle\Form\AdminType', $admin);
      $form->handleRequest($r);

      if ($form->isSubmitted() && $form->isValid()) {
        $um = $this->get('fos_user.user_manager');
        $um->updateUser($admin);
        return $this->redirectToRoute('admin_list');
      }

      return $this->render('AppBundle:Admin:update.html.twig', array(
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="admin_delete")
     */
    public function deleteAction($id)
    {
      $admin = $this->getDoctrine()
      ->getRepository(Admin::class)
      ->find($id);

      $um = $this->get('fos_user.user_manager');
      $um->deleteUser($admin);

        return $this->redirectToRoute('admin_list');
    }

    /**
     * @Route("/volunteer", name="admin_volunteer")
     */
    public function volunteerAction()
    {
        return $this->render('AppBundle:Admin:volunteer.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/article", name="admin_article")
     */
    public function articleAction()
    {
        return $this->render('AppBundle:Admin:article.html.twig', array(
            // ...
        ));
    }

}
