<?php

namespace QT\SystemeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\SystemeBundle\Entity\Noeud;
use QT\SystemeBundle\Form\NoeudType;
use QT\SystemeBundle\Entity\Application;

class SystemeController extends Controller
{
    /**
     * Accueil de la partie PF (système, métrologie, applicatif)
     * editable par l'administrateur de la PF
     */
    public function indexAction()
    {
        return $this->render('QTSystemeBundle::pf.html.twig');
    }
    
    /**
     * Affichage des différents serveurs de la PF et de la description de l'appli
     */
    public function listerNoeudAction()
    {
        $em = $this->getDoctrine()->getManager('infra');
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud', 'infra')->findAll();
        $application = $em->getRepository('QTSystemeBundle:Application', 'infra')->findOneByNom('Blocnotes');
        
        return $this->render('QTSystemeBundle::systeme.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    'application' => $application,
                                    ));
    }
    
    /**
     * Edition ou création d'un noeud
     */
    public function editerNoeudAction(Request $request, $noeud_num = null)
    {
        $em = $this->getDoctrine()->getManager('infra');
        if($noeud_num == ''){
            $noeud = new Noeud();
        }else{
            $noeud = $em->getRepository('QTSystemeBundle:Noeud', 'infra')->findOneById($noeud_num);
        }
        $formulaire = $this->createForm(NoeudType::class, $noeud);
        
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud', 'infra')->findAll();
        
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $em->persist($noeud);
                $em->flush();
                
                return $this->redirectToRoute('afficher_systeme');
            }
        }
        
        return $this->render('QTSystemeBundle::noeud_edition.html.twig', array(
                                    'noeud' => $noeud,
                                    'liste_noeuds' => $listeNoeuds,
                                    'formulaire' => $formulaire->createView(),
                                    ));
    }
    
    /**
     * Suppression d'un noeud
     */
    public function supprimerNoeudAction($noeud_num)
    {
        $em = $this->getDoctrine()->getManager('infra');
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud', 'infra')->findOneById($noeud_num);
        //$listeNoeuds = array('serv-apache','serv-data','serv-infra','cloud');
        
        return $this->render('QTSystemeBundle::systeme.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    ));
    }
}
