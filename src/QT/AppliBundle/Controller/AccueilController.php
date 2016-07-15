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
        $em = $this->getDoctrine()->getManager();
        $liste_hyperviseurs = $em->getRepository('QTCartographieBundle:Hyperviseur')->findAll();
        $liste_applications = $em->getRepository('QTCartographieBundle:Application')->findAll();
        
        $kernel = $this->container->get('kernel');
        $bundles = $kernel->getBundles();
        return $this->render('QTAppliBundle::accueil.html.twig', array(
                                            'liste_hyperviseurs' => $liste_hyperviseurs,
                                            'liste_applications' => $liste_applications,
                                            'liste_bundles' => $bundles,                          
                                            ));
    }
}
