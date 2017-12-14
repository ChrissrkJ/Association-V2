<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/qsn", name="page_qsn")
     */

    public function qsnAction()
    {
        // replace this example code with whatever you need
        return $this->render('qsn.html.twig');
    }


    /**
     * @Route("/legal", name="page_legal")
     */
    public function legalAction()
    {
        // replace this example code with whatever you need
        return $this->render('legal.html.twig');
    }

    
}
