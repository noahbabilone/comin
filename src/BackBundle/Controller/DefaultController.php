<?php

namespace BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="back_home")
     */
    public function indexAction()
    {
        return $this->render('BackBundle:Default:index.html.twig');
    }
}
