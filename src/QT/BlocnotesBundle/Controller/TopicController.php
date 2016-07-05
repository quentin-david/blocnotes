<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QT\BlocnotesBundle\Entity\Topic;
use QT\BlocnotesBundle\Entity\Verrou;
use QT\AdminBundle\Entity\Utilisateur;
use QT\AdminBundle\Entity\Domaine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\BlocnotesBundle\Form\Type\TopicType;
use QT\BlocnotesBundle\Form\Type\TopicInterventionType;

class TopicController extends Controller
{
	/**
	 *
	 */
    public function afficherTopicAction($topic)
    {
        // execution du template topic ou DI
		if($topic->getIntervention() != ''){
			return $this->render('QTBlocnotesBundle:Topic:topic_di.html.twig', array(
										'topic' => $topic
									));
		}else{
			return $this->render('QTBlocnotesBundle:Topic:topic.html.twig', array(
										'topic' => $topic
									));
		}
    }
    
    /**
     * Editer ou creer un topic/DI
     */ 
    public function editerTopicAction(Request $request, $topic_num=null, $topic_type=null)
    {
		//ENtity Manager
        $em = $this->getDoctrine()->getManager();
        
        // Objet Emplacement pour le formulaire
        if($topic_num === null){
			$topic = new Topic; // Creation
		}else{
			$topic = $em->getRepository('QTBlocnotesBundle:Topic')->find($topic_num); //Edition
		}

		// Creation du formulaire générique de création d'un topic
		// en fonction du type de topic
		switch($topic_type){
			case "topic":
				$formulaire = $this->createForm(TopicType::class, $topic); // topic classique
				break;
			case "DI":
				$formulaire = $this->createForm(TopicInterventionType::class, $topic); // DI
				break;
		}			
        
        //Enregistrement en base
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isValid()){
				$topic->setCreateur($this->getUser());
				//$verrou_a_supprimer = $topic->getVerrou();
				//$topic->setVerrou(null);
				// A l'enregistrement on libère le verrou
                $em->persist($topic);
				//$em->remove($verrou_a_supprimer);
                $em->flush();
                
				// Redirection vers les topics du meme domaine
                return $this->redirectToRoute('lister_topic', array('topic_recherche[domaines]' => $request->get('topic')['domaines']));
            }
        }
		// Verification d'un eventuel verrou sur le topic
		/*$verrou = $topic->getVerrou();
		if($verrou == ''){
			$verrou = new Verrou;
			$verrou->setUtilisateur($this->getUser());
			$topic->setVerrou($verrou);
			// On enregistre en base
			$em->persist($topic);
            $em->flush();
		}*/

		
		// Affichage du template d'edition du topic/DI
    	return $this->render('QTBlocnotesBundle:Topic:topic_edition.html.twig', array(
									'topic_num' => $topic_num,
									'topic' => $topic,
									'topic_type' => $topic_type,
									'formulaire' => $formulaire->createView(),							
							));
    }
	
	
	/**
	 * Suppression du topic (avec demande de confirmation)
	 */
	public function supprimerTopicAction(Request $request,$topic_num)
	{
		//ENtity Manager
        $em = $this->getDoctrine()->getManager();
		$topic_a_supprimer = $em->getRepository('QTBlocnotesBundle:Topic')->find($topic_num);
        
        // Verification que le topic existe bien
		if($request->isMethod('POST')){
			//$topic_a_supprimer = $em->getRepository('QTBlocnotesBundle:Topic')->find($topic_num);
			if($topic_a_supprimer != ''){
				$em->remove($topic_a_supprimer);
				$em->flush();
			}
			return $this->redirectToRoute('lister_topic');
		}
			// Redirection vers les topics du meme domaine
            return $this->render('QTBlocnotesBundle:Topic:topic_suppression.html.twig',array('topic' => $topic_a_supprimer));
	}
	
}
