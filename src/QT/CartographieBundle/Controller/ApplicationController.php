<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use QT\AdminBundle\Entity\Utilisateur;
use QT\CartographieBundle\Form\ApplicationType;
use QT\CartographieBundle\Entity\Application;

class ApplicationController extends Controller
{
    /**
     * Affichage des différents serveurs de la PF et de la description de l'appli
     */
    public function afficherApplicationAction($application_num)
    {
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository('QTCartographieBundle:Application')->find($application_num);
        $listeNoeuds = $em->getRepository('QTCartographieBundle:Noeud')->findByApplication($application);
        
        return $this->render('QTCartographieBundle::application.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    'application' => $application,
                                    ));
    }
    
    
    /**
     * Affichage de la description de l'application de la PF
     */
    public function editerApplicationAction(Request $request, $application_num=null)
    {
        $em = $this->getDoctrine()->getManager();
        
        if($application_num == null){
            $application = new Application();
        }else{
            $application = $em->getRepository('QTCartographieBundle:Application')->find($application_num);
        }
        
        $listeNoeuds = $em->getRepository('QTCartographieBundle:Noeud')->findByApplication($application);
        
         //Creation de l'objet formulaire
        $formulaire = $this->createForm(ApplicationType::class, $application);
        
        // Enregistrement de l'utilisateur
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if ($formulaire->isSubmitted() && $formulaire->isValid()) {
                $em->persist($application);
                $em->flush();
                return $this->redirectToRoute('afficher_application', array('application_num' => $application->getId()));       
            }
        }
        
        return $this->render('QTCartographieBundle::application_edition.html.twig', array(
                                    'application' => $application,
                                    'liste_noeuds' => $listeNoeuds,
                                    'formulaire' => $formulaire->createView(),
                                    ));
    }
}
