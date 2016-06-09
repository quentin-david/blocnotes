<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\BlocnotesBundle\Entity\Topic;
use QT\AdminBundle\Entity\Domaine;
use QT\BlocnotesBundle\Form\Type\TopicRechercheType;

class TopicListeController extends Controller
{
    /**
     * 
     */
    public function listerTopicAction(Request $request)
    {
        // Objet Topic pour le formulaire
        $topic = new Topic;
        $liste_topics = array();
        
        // Utilisation du formulaire générique défini dans BlocnotesBundle/Form/Type
        $formulaire_recherche = $this->createForm(TopicRechercheType::class, $topic, array('csrf_protection' => false));
        
        $em = $this->getDoctrine()->getManager();
        $liste_topics = $em->getRepository('QTBlocnotesBundle:Topic')->findAll();
        
        $formulaire_recherche->handleRequest($request);
        if($formulaire_recherche->isValid()){
            //Gestion des objets Topic
            if($formulaire_recherche->getData() != ''){
                $query = $em->getRepository('QTBlocnotesBundle:Topic')->search($formulaire_recherche->getData());
                $liste_topics = $query->getResult();
            }
        }
        
        return $this->render('QTBlocnotesBundle:Topic:topic_liste.html.twig', array(
                                        'liste_topics' => $liste_topics,
                                        'formulaire_recherche' => $formulaire_recherche->createView()
                            ));
    }
}
