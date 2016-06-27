<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use QT\BlocnotesBundle\Entity\Verrou;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Verrou sur les topics
 */
class VerrouController extends Controller
{
    /**
     * Poser le verrou
     */
    public function poserVerrouAction($utilisateur,$topic){
        $em = $this->getDoctrine()->getManager();
        $verrou = new Verrou;
        $verrou->setIdUtilisateur($utilisateur);
        $verrou->setIdTopic($topic);
        $verrou->setVerrouille(1);
    }
    
    /**
     * Verifie si un verrou est posé sur la ressource
     */
    public function verifierVerrouAction($utilisateur,$topic){
        $em = $this->getDoctrine()->getManager();
        $verrou = $em->getRepository('QTBlocnotesBundle:Verrou')->findBy(
                                                array('id_topic' => $topic),
                                                array('id_utilisateur' => $utilisateur)
                                                );
    }   
    
    /**
     * Supprime un topic
     */
    public function libererVerrouAction($utilisateur,$topic){
        $em = $this->getDoctrine()->getManager();
        $verrou = $em->getRepository('QTBlocnotesBundle:Verrou')->findBy(
                                                array('id_topic' => $topic),
                                                array('id_utilisateur' => $utilisateur)
                                                );
    }    
}