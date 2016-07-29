<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\CartographieBundle\Entity\Noeud;
use QT\CartographieBundle\Entity\Hyperviseur;
use QT\CartographieBundle\Form\NoeudType;
use QT\CartographieBundle\Entity\Application;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MutualisationController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        return $this->render('QTCartographieBundle::mutualisation.html.twig');
    }
    
    
    
    /**
     * Page d'accueil de la cartographie globale des hyperviseurs
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function afficherCartographieSystemeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeNoeuds = $em->getRepository('QTCartographieBundle:Noeud')->findAll();
        $listePlateformes = $em->getRepository('QTCartographieBundle:Application')->findAll();
        $listeHyperviseurs = $em->getRepository('QTCartographieBundle:Hyperviseur')->findAll();
        
        
        return $this->render('QTCartographieBundle::cartographie_systeme.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    'liste_plateformes' => $listePlateformes,
                                    'liste_hyperviseurs' => $listeHyperviseurs,
                                    ));        
    }

}