<?php

namespace QT\SystemeBundle\Controller;

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
use QT\SystemeBundle\Form\ApplicationType;
use QT\SystemeBundle\Entity\Application;

class ApplicationController extends Controller
{
    /**
     * Affichage de l'application
     */
    public function afficherApplicationAction()
    {
        $em = $this->getDoctrine()->getManager('infra');
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud', 'infra')->findAll();
        $application = $em->getRepository('QTSystemeBundle:Application', 'infra')->findOneByNom('Blocnotes');
        if($application == null){
            $application = new Application();
        }
        
        return $this->render('QTSystemeBundle::application.html.twig', array(
                                    'liste_noeuds' => $listeNoeuds,
                                    'application' => $application,
                                    ));
    }
    
    
    /**
     * Affichage de la description de l'application de la PF
     */
    public function editerApplicationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('infra');
        
        $listeNoeuds = $em->getRepository('QTSystemeBundle:Noeud', 'infra')->findAll();
        
        $application = $em->getRepository('QTSystemeBundle:Application', 'infra')->findOneByNom('Blocnotes');
        if($application == null){
            $application = new Application();
        }
        
         //Creation de l'objet formulaire
        $formulaire = $this->createForm(ApplicationType::class, $application);
        
        // Enregistrement de l'utilisateur
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if ($formulaire->isSubmitted() && $formulaire->isValid()) {
                $em->persist($application);
                $em->flush();
                return $this->redirectToRoute('afficher_application');       
            }
        }
        
        return $this->render('QTSystemeBundle::application_edition.html.twig', array(
                                    'application' => $application,
                                    'liste_noeuds' => $listeNoeuds,
                                    'formulaire' => $formulaire->createView(),
                                    ));
    }
}
