<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UtilisateurController extends Controller
{
    /**
     * 
     */
    public function indexAction($userName)
    {
        // replace this example code with whatever you need
                return $this->render('default/user.html.twig', array('userName' => $userName));
    }
}