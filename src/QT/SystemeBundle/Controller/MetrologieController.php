<?php

namespace QT\SystemeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MetrologieController extends Controller
{
    /**
     * Affichage de la page d'admin du serveur (Munin, Nagios...)
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeApplications = $em->getRepository('QTCartographieBundle:Application')->findAll();
        $listeInfos = array('diskstats_iops-','cpu-', 'memory-'); //Liste des graphes a afficher directement
        $niveauDetail = 'day';
        return $this->render('QTSystemeBundle::metrologie.html.twig', array(
                                    'liste_applications' => $listeApplications,
                                    'niveau_detail' => $niveauDetail,
                                    'liste_infos' => $listeInfos,
                                    ));
    }
    
    
    /**
     * Affichage des données de métrologie pour un noeud donné
     */
    public function afficherMetrologieNoeudAction($noeud_num)
    {
        $em = $this->getDoctrine()->getManager();
        $noeud = $em->getRepository('QTCartographieBundle:Noeud')->find($noeud_num);
        if($noeud == null){
            $noeud = $em->getRepository('QTCartographieBundle:Hyperviseur')->find($noeud_num);
            if($noeud == null){
                return false;
            }
        }
        
        $listeInfos = array('diskstats_iops-','cpu-','memory-'); //Liste des graphes a afficher directement
        $niveauDetail = 'day';
        return $this->render('QTSystemeBundle::metrologie_noeud.html.twig', array(
                            'niveau_detail' => $niveauDetail,
                            'liste_infos' => $listeInfos,
                            'noeud' => $noeud,
                        ));
        
    }
}
