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
use QT\BlocnotesBundle\Form\TopicBugzillaType;

class TopicController extends Controller
{
	/**
	 * Affichage d'un topic unique (appelé par topic liste)
	 */
    public function afficherTopicAction($topic)
    {
        // execution du template topic ou DI
		if($topic->getIntervention() != ''){
			return $this->render('QTBlocnotesBundle:Topic:topic_di.html.twig', array(
										'topic' => $topic
									));
		}elseif($topic->getIntervention() != ''){
			return $this->render('QTBlocnotesBundle:Bugzilla:bugzilla.html.twig', array(
										'bug' => $topic
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
			case "bug":
				$formulaire = $this->createForm(TopicBugzillaType::class, $topic); // Bugzilla
				break;
		}			
        
        //Enregistrement en base
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isValid()){
				$topic->setCreateur($this->getUser());
				//$topic->getPjs()->upload();
                $em->persist($topic);
                $em->flush();
                
				// Redirection vers les topics du meme domaine
                return $this->redirectToRoute('lister_topic', array('topic_recherche[domaines]' => $request->get('topic')['domaines']));
            }
        }
		
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
	}
	
	
	/**
	 * Suppression PJ d'un topic
	 */
	public function supprimerPjAction(Request $request, $pj_num)
	{
		$em = $this->getDoctrine()->getManager();
		$pj_a_supprimer = $em->getRepository('QTBlocnotesBundle:PieceJointe')->find($pj_num);
		// Verification que le topic existe bien
		if($pj_a_supprimer != ''){
			$pj_a_supprimer->getTopic()->removePj($pj_a_supprimer); //dereferecement au niveau du topic
			$pj_a_supprimer->deleteFile(); // suppression du fichier physique
			$em->remove($pj_a_supprimer); //suppression de l'objet PJ
			$em->flush();
		}
		return $this->redirectToRoute('lister_topic');
	}
	
}
