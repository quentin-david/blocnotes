<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use QT\BlocnotesBundle\Entity\Topic;
use QT\BlocnotesBundle\Entity\Utilisateur;
use QT\BlocnotesBundle\Entity\Domaine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * 
     */ 
    public function editerTopicAction(Request $request, $num_topic=null)
    {
		//ENtity Manager
        $em = $this->getDoctrine()->getManager();
        
        // Objet Emplacement pour le formulaire
        if($num_topic === null){
			$topic = new Topic;
		}else{
			$topic = $em->getRepository('QTBlocnotesBundle:Topic')->find($num_topic);
		}
        
        //Creation de l'objet formulaire
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $topic);
        $formBuilder
            ->add('titre', TextType::class)
			->add('createur', EntityType::class, array('class' => 'QTBlocnotesBundle:Utilisateur', 'choice_label' => 'username'))
			->add('domaine', EntityType::class, array('class' => 'QTBlocnotesBundle:Domaine', 'choice_label' => 'libelle'))
			->add('corps', TextareaType::class)
            ->add('save', SubmitType::class);   
        $formulaire = $formBuilder->getForm();
         
        // Liste des types d'emplacement avec le nombre d'emplacements pour chaque
        $liste_domaines = $em->getRepository('QTBlocnotesBundle:Domaine')->findAll();        
        
        //Enregistrement en base
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isValid()){
                $em->persist($topic);
                $em->flush();
                
                return $this->redirectToRoute('accueil');
            }
        }
    	return $this->render('QTBlocnotesBundle:Topic:topic_edition.html.twig', array(
									'num_topic' => $num_topic,
									'formulaire' => $formulaire->createView(),							
							));
    }
}
