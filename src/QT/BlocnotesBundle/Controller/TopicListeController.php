<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\BlocnotesBundle\Entity\Topic;
use QT\BlocnotesBundle\Entity\Domaine;
use QT\BlocnotesBundle\Form\Type\TopicRechercheType;

class TopicListeController extends Controller
{
    /**
     * 
     */
    public function listerTopicAction($createur=null)
    {
        //Gestion des objets Topic
        $em = $this->getDoctrine()->getManager();
        $liste_topics = $em->getRepository('QTBlocnotesBundle:Topic')->findAll();
        
        // Objet Topic pour le formulaire
        $topic = new Topic;
        
        // Utilisation du formulaire générique défini dans BlocnotesBundle/Form/Type
        $formulaire_recherche = $this->createForm(TopicRechercheType::class, $topic);
        
        return $this->render('QTBlocnotesBundle:Topic:topic_liste.html.twig', array(
                                        'liste_topics' => $liste_topics,
                                        'formulaire_recherche' => $formulaire_recherche->createView()
                            ));
    }
}
