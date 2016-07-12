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

class DonneeController extends Controller
{
    /**
     * Page d'accueil dela carto des base de données
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('infra');
        //$listeBdds = $em->getRepository('QTCartographiesBundle:Donnee', 'infra')->findAll();
        $listeBdds = ['blocnotes', 'infra'];
        return $this->render('QTCartographieBundle::donnee.html.twig', array(
                                    'liste_bdds' => $listeBdds,                                         
                                    ));        
    }

}