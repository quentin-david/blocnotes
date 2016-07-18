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
        $listeHyperviseurs = $em->getRepository('QTCartographieBundle:Hyperviseur')->findAll();
        $listeInfos = array('diskstats_iops-','cpu-', 'memory-'); //Liste des graphes a afficher directement
        $niveauDetail = 'day';
        return $this->render('QTSystemeBundle::metrologie.html.twig', array(
                                    'liste_applications' => $listeApplications,
                                    'liste_hyperviseurs' => $listeHyperviseurs,
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
    
    /**
     * Affichage des graphes par hyperviseur et par type de profilage
     * (graphe de l'hyperviseur en grand avec en dessous les graphes de ses VMs)
     */
    public function afficherProfilingAction($hyperviseur_num, $profiling_type=null)
    {
        $em = $this->getDoctrine()->getManager();
        $hyperviseur = $em->getRepository('QTCartographieBundle:Hyperviseur')->find($hyperviseur_num);
        $liste_noeuds = $hyperviseur->getNoeuds();
        $niveauDetail = 'day';
        switch($profiling_type){
            case 'cpu':
                $liste_indicateurs = ['cpu-','load-'];
                break;
            case 'memory':
                $liste_indicateurs = ['memory-'];
                break;
            case null:
                $liste_indicateurs = null;
                break;
        }
                  
        return $this->render('QTSystemeBundle::profiling.html.twig', array(
                                        'hyperviseur' => $hyperviseur,
                                        'liste_noeuds' => $liste_noeuds,
                                        'liste_indicateurs' => $liste_indicateurs,
                                        'niveau_detail' => $niveauDetail,
                                        ));
    }
}
