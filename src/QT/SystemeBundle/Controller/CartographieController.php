<?php

namespace QT\SystemeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use QT\SystemeBundle\Entity\Noeud;
use QT\SystemeBundle\Form\NoeudType;

class CartographieController extends Controller
{
    /**
     * Affichage des différents serveurs de la PF et de la description de l'appli
     */
    public function listerNoeudAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud')->findAll();
        $application = $em->getRepository('QTSystemeBundle:Application')->findOneByNom('Blocnotes');
        //$listeNoeuds = array('serv-apache','serv-data','serv-infra','cloud');
        
        return $this->render('QTSystemeBundle::cartographie.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    'application' => $application,
                                    ));
    }
    
    /**
     * Edition ou création d'un noeud
     */
    public function editerNoeudAction(Request $request, $noeud_num = null)
    {
        $em = $this->getDoctrine()->getManager();
        if($noeud_num == ''){
            $noeud = new Noeud();
        }else{
            $noeud = $em->getRepository('QTSystemeBundle:Noeud')->findOneById($noeud_num);
        }
        $formulaire = $this->createForm(NoeudType::class, $noeud);
        
        //$listeNoeuds = array('serv-apache','serv-data','serv-infra','cloud');
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud')->findAll();
        
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $em->persist($noeud);
                $em->flush();
                
                //return $this->redirectToRoute('editer_noeud', array('noeud_num' => $noeud->getId()));
                return $this->redirectToRoute('afficher_cartographie');
            }
        }
        
        return $this->render('QTSystemeBundle::noeud.html.twig', array(
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
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud')->findOneById($noeud_num);
        //$listeNoeuds = array('serv-apache','serv-data','serv-infra','cloud');
        
        return $this->render('QTSystemeBundle::cartographie.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    ));
    }
}
