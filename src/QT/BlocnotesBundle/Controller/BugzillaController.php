<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QT\AdminBundle\Entity\Utilisateur;
use QT\AdminBundle\Entity\Domaine;
use QT\BlocnotesBundle\Entity\Bugzilla;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\BlocnotesBundle\Form\BugzillaType;
use QT\BlocnotesBundle\Form\BugzillaRechercheType;

class BugzillaController extends Controller
{
	/**
	 * Affichage d'un bug
	 */
    public function afficherBugAction($bug)
    {
        // affichage d'un bug
		return $this->render('QTBlocnotesBundle:Bugzilla:bugzilla.html.twig', array(
										'bug' => $bug
									));
    }
    
     /**
     * 
     */
    public function listerBugAction(Request $request)
    {
        $bug = new Bugzilla;
        $em = $this->getDoctrine()->getManager();
        // Par défaut affichage de tous les topics
        $liste_bugs = $em->getRepository('QTBlocnotesBundle:Bugzilla')->findAll();
        
        $formulaire_recherche = $this->createForm(BugzillaRechercheType::class, $bug, array('csrf_protection' => false));
        // Récupération des valeurs passées par le formulaire de recherche
        $formulaire_recherche->handleRequest($request);
        if($formulaire_recherche->isValid()){
            // SI des paramètres ont été passés
            if($formulaire_recherche->getData() != ''){
                // Methode par pseudo SQL
                $query = $em->getRepository('QTBlocnotesBundle:Bugzilla')->search($formulaire_recherche->getData());
                $liste_bugs = $query->getResult();                
            }
        }
        
        return $this->render('QTBlocnotesBundle:Bugzilla:bugzilla_liste.html.twig', array(
                                        'formulaire_recherche' => $formulaire_recherche->createView(),
                                        'liste_bugs' => $liste_bugs,
                            ));
    }
    
    /**
     * Editer ou creer un topic/DI
     */ 
    public function editerBugAction(Request $request, $bug_num=null)
    {
		//ENtity Manager
        $em = $this->getDoctrine()->getManager();
        
        // Objet Emplacement pour le formulaire
        if($bug_num === null){
			$bug = new Bugzilla; // Creation
		}else{
			$bug = $em->getRepository('QTBlocnotesBundle:Bugzilla')->find($bug_num); //Edition
		}

		// Creation du formulaire générique de création d'un topic
		$formulaire = $this->createForm(BugzillaType::class, $bug); // topic classique
		
        
        //Enregistrement en base
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isValid()){
				$bug->setCreateur($this->getUser());
                $em->persist($bug);
                $em->flush();
                
				// Redirection vers les topics du meme domaine
                return $this->redirectToRoute('lister_bug');
            }
        }
		
		// Affichage du template d'edition du topic/DI
    	return $this->render('QTBlocnotesBundle:Bugzilla:bugzilla_edition.html.twig', array(
                                    'formulaire' => $formulaire->createView(),
									'bug_num' => $bug_num,
									'bug' => $bug,							
							));
    }
	
	
	/**
	 * Suppression du topic (avec demande de confirmation)
	 */
	/*public function supprimerTopicAction(Request $request,$topic_num)
	{
		//ENtity Manager
        $em = $this->getDoctrine()->getManager();
		$topic_a_supprimer = $em->getRepository('QTBlocnotesBundle:Topic')->find($topic_num);
        
        // Verification que le topic existe bien
		if($request->isMethod('POST')){
			//$topic_a_supprimer = $em->getRepository('QTBlocnotesBundle:Topic')->find($topic_num);
			if($topic_a_supprimer != ''){
				//Suppression des PJs et de leur fichier
				if($topic_a_supprimer->getPjs() != null){
					foreach($topic_a_supprimer->getPjs() as $pj){
						$pj->deleteFile();
						$em->remove($pj);
					}
				}
				$em->remove($topic_a_supprimer);
				$em->flush();
			}
			return $this->redirectToRoute('lister_topic');
		}
			// Redirection vers les topics du meme domaine
            return $this->render('QTBlocnotesBundle:Topic:topic_suppression.html.twig',array('topic' => $topic_a_supprimer));
	}*/
	
}
