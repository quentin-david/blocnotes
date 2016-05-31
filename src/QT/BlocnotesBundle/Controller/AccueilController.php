<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\BlocnotesBundle\Entity\Topic;

class AccueilController extends Controller
{
    /**
     * 
     */
    public function listerTopicAction()
    {
        // replace this example code with whatever you need
        $liste_topics = [1,2,3];
        //return $this->render('QTBlocnotesBundle::accueil.html.twig', array('liste_topics' => $liste_topics));
        
        //ENtity Manager
        $em = $this->getDoctrine()->getManager();
        
        // Objet Emplacement pour le formulaire
        $topic = new Topic;
        
        //Creation de l'objet formulaire
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $topic);
        $formBuilder
            ->add('createur', EntityType::class, array('class' => 'QTBlocnotesBundle:Topic', 'choice_label' => 'createur'))
            ->add('rechercher', SubmitType::class);   
        $formulaire_recherche = $formBuilder->getForm();
        
        return $this->render('QTBlocnotesBundle::accueil.html.twig', array(
                                        'liste_topics' => $liste_topics,
                                        'formulaire_recherche' => $formulaire_recherche
                            ));
    }
}
