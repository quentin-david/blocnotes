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
        $kernel = $this->container->get('kernel');
        $bundles = $kernel->getBundles();
        return $this->render('QTAppliBundle::accueil.html.twig', array(
                                            'liste_bundles' => $bundles,                          
                                            ));
    }
}
