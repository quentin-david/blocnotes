<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller
{
    /**
     * 
     */
    public function listerTopicAction()
    {
        // replace this example code with whatever you need
        $liste_topics = [1,2,3];
        return $this->render('QTBlocnotesBundle::accueil.html.twig', array('liste_topics' => $liste_topics));
    }
}
