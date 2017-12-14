<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/index", name="article_list")
     */
    public function indexAction()
    {
      $articles = $this->getDoctrine()
      ->getRepository(Article::class)
      ->findAll();
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('AppBundle:Article:index.html.twig', array(
            'articles'  => $articles
        ));
    }

    /**
     * @Route("/add",name="article_add")
     */
    public function addAction(Request $r)
    {
      $article = new Article();

      $form = $this->createFormBuilder($article)
          ->add('title')
          ->add('body', TextareaType::class)
          ->add('createdAt', DateType::class)
          ->add('updateAt', DateType::class)
          ->add('submit', SubmitType::class, array(
            'label' => 'Enregistrer'
          ))
          ->getForm();

      $form->handleRequest($r);

      if ($form->isSubmitted() && $form->isValid()){

        $article = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->redirectToRoute('article_list');
      }
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('AppBundle:Article:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/update/{id}", name="article_update")
     */
    public function updateAction(Request $r, $id)
    {
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->find($id);

      $form = $this->createFormBuilder($article)
          ->add('title')
          ->add('body', TextareaType::class)
          ->add('createdAt', DateType::class)
          ->add('updateAt', DateType::class)
          ->add('submit', SubmitType::class, array(
            'label' => 'Enregistrer'
          ))
          ->getForm();

      $form->handleRequest($r);

      if ($form->isSubmitted() && $form->isValid()){
        $article = $form->getData();
        // $file = $article->getImage();
        // $fileName = 'article_'.$file->getClientOriginalName().'.'.$file->guessExtension();
        // $file->move($this->getParameter('dir_article'), $fileName);
        // $article->setImage($fileName);
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->redirectToRoute('article_list');
      }
      $this->denyAccessUnlessGranted('ROLE_ADMIN');
      return $this->render('AppBundle:Article:update.html.twig', array(
          'form' => $form->createView()
      ));
    }

    /**
     * @Route("/delete/{id}", name="article_delete")
     */
    public function deleteAction($id)
    {
      $article = $this->getDoctrine()
      ->getRepository(Article::class)
      ->find($id);

      $em = $this->getDoctrine()->getManager();
      $em->remove($article);
      $em->flush();
        return $this->render('article_list');
    }

    /**
     * @Route("/autism_info", name="autism_info")
     */
    public function infoAction()
    {
      $articles = $this->getDoctrine()
      ->getRepository(Article::class)
      ->findAll();

        return $this->render('AppBundle:AutismInfo:index.html.twig', array(
            'articles' => $articles
        ));
    }
}
