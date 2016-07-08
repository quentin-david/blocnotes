<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\SystemeBundle\Entity\Noeud;
use QT\CartographieBundle\Entity\Hyperviseur;
use QT\SystemeBundle\Form\NoeudType;
use QT\SystemeBundle\Entity\Application;

class PlateformeController extends Controller
{
    /**
     * Page d'accueil de la cartographie globale
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('infra');
        $listePlateformes = $em->getRepository('QTSystemeBundle:Application', 'infra')->findAll();
        $listeHyperviseurs = $em->getRepository('QTCartographieBundle:Hyperviseur', 'infra')->findAll();
        return $this->render('QTCartographieBundle::plateforme.html.twig', array(
                                    'liste_plateformes' => $listePlateformes,
                                    'liste_hyperviseurs' => $listeHyperviseurs,
                                    ));        
    }

}