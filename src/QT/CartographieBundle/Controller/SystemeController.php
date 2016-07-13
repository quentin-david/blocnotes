<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\CartographieBundle\Entity\Noeud;
use QT\CartographieBundle\Form\NoeudType;
use QT\CartographieBundle\Entity\Application;

class SystemeController extends Controller
{    
    /**
     *  Affichage d'un seul noeud avec toutes ses infos et data
     */
    public function afficherNoeudAction($noeud_num)
    {
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository('QTCartographieBundle:Application')->findOneByNom('Blocnotes');
        $listeNoeuds = $em->getRepository('QTCartographieBundle:Noeud')->findByApplication($application);
        $noeud = $em->getRepository('QTCartographieBundle:Noeud')->find($noeud_num);
        
        return $this->render('QTCartographieBundle::noeud.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    'noeud' => $noeud,
                                    ));
    }
    
    
    /**
     * Edition ou création d'un noeud
     */
    public function editerNoeudAction(Request $request, $application_num, $noeud_num = null)
    {
        $em = $this->getDoctrine()->getManager();
        // On affiche que les noeuds de l'application courante
        $application = $em->getRepository('QTCartographieBundle:Application')->findOneByNom('Blocnotes');
        
        if($noeud_num == ''){
            $noeud = new Noeud();
        }else{
            $noeud = $em->getRepository('QTCartographieBundle:Noeud')->findOneById($noeud_num);
            if($noeud == '' || $noeud->getApplication() != $application){
                $noeud = new Noeud(); //cas ou le noeud n'existe pas ou n'appartient pas à cette application
            }
        }
        $formulaire = $this->createForm(NoeudType::class, $noeud);
        
        $listeNoeuds = $em->getRepository('QTCartographieBundle:Noeud')->findByApplication($application);
        
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $noeud->setApplication($application);
                $em->persist($noeud);
                $em->flush();
                
                return $this->redirectToRoute('afficher_application', array(
                                    'application_num' => $application->getId(),
                                    ));
            }
        }
        
        return $this->render('QTCartographieBundle::noeud_edition.html.twig', array(
                                    'application' => $application,
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
        $em = $this->getDoctrine()->getManager();
        $listeNoeuds = $em->getRepository('QTCartographieBundle:Noeud')->findOneById($noeud_num);
        
        return $this->render('QTCartographieBundle::systeme.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    ));
    }
}
