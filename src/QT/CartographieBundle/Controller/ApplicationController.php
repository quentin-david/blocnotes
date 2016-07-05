<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\SystemeBundle\Entity\Noeud;
use QT\SystemeBundle\Form\NoeudType;
use QT\SystemeBundle\Entity\Application;

class ApplicationController extends Controller
{
    /**
     * Page d'accueil de la cartographie globale
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('infra');
        //$listeApplications = $em->getRepository('QTSystemeBundle:Application', 'infra')->findAll();
        $listeBundles = ["SystemeBundle","AdminBundle"];
        return $this->render('QTCartographieBundle::application.html.twig', array(
                                    'liste_bundles' => $listeBundles,
                                    ));        
    }

}