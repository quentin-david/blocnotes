<?php

namespace QT\CartographieBundle\Controller;

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
        $listeMachines = array('serv-apache','serv-data','serv-infra','cloud');
        $listeInfos = array('diskstats_iops-week','if_ens3-week','cpu-week'); //Liste des graphes a afficher directement
        return $this->render('QTCartographieBundle::metrologie.html.twig', array(
                                    'liste_machines' => $listeMachines,
                                    'liste_infos' => $listeInfos,
                                    ));
    }
}
