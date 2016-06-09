<?php

namespace QT\AppliBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller
{
    /**
     * 
     */
    public function indexAction()
    {
        return $this->render('QTAppliBundle::accueil.html.twig');
    }
}
