<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QT\BlocnotesBundle\Entity\Topic;
use QT\AdminBundle\Entity\Utilisateur;
use QT\AdminBundle\Entity\Domaine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\BlocnotesBundle\Form\Type\TopicType;

class TopicController extends Controller
{
	/**
	 *
	 */
    public function afficherTopicAction($topic)
    {
        // replace this example code with whatever you need
        return $this->render('QTBlocnotesBundle:Topic:topic.html.twig', array('topic' => $topic));
    }
    
    /**
     * Editer ou creer un topic
     */ 
    public function editerTopicAction(Request $request, $num_topic=null)
    {
		//ENtity Manager
        $em = $this->getDoctrine()->getManager();
        
        // Objet Emplacement pour le formulaire
        if($num_topic === null){
			$topic = new Topic; // Creation
		}else{
			$topic = $em->getRepository('QTBlocnotesBundle:Topic')->find($num_topic); //Edition
		}

		// Creation du formulaire générique 
		$formulaire = $this->createForm(TopicType::class, $topic);      
        
        //Enregistrement en base
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isValid()){
                $em->persist($topic);
                $em->flush();
                
				// Redirection vers les topics du meme domaine
                return $this->redirectToRoute('lister_topic', array('topic_recherche[domaine]' => $request->get('topic')['domaine']));
            }
        }
    	return $this->render('QTBlocnotesBundle:Topic:topic_edition.html.twig', array(
									'num_topic' => $num_topic,
									'formulaire' => $formulaire->createView(),							
							));
    }
	
	
	/**
	 *
	 */
	public function supprimerTopicAction(Request $request,$num_topic)
	{
		//ENtity Manager
        $em = $this->getDoctrine()->getManager();
        
        // Verification que le topic existe bien
		if($request->isMethod('POST')){
			$topic_a_supprimer = $em->getRepository('QTBlocnotesBundle:Topic')->find($num_topic);
			if($topic_a_supprimer != ''){
				$em->remove($topic_a_supprimer);
				$em->flush();
			}
			return $this->redirectToRoute('lister_topic');
		}
			// Redirection vers les topics du meme domaine
            return $this->render('QTBlocnotesBundle:Topic:topic_suppression.html.twig',array('num_topic' => $num_topic));
	}
	
}
