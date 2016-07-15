<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\CartographieBundle\Entity\Noeud;
use QT\CartographieBundle\Entity\Hyperviseur;
use QT\CartographieBundle\Form\NoeudType;
use QT\CartographieBundle\Entity\Application;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MutualisationController extends Controller
{
    /**
     * Page d'accueil de la cartographie globale des hyperviseurs
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listePlateformes = $em->getRepository('QTCartographieBundle:Application')->findAll();
        $listeHyperviseurs = $em->getRepository('QTCartographieBundle:Hyperviseur')->findAll();
        $listeReseaux = Array();
        foreach($listeHyperviseurs as $hyperviseur){
            foreach($hyperviseur->getNoeuds() as $noeud){
                foreach($this->getReseaux($noeud) as $reseau){
                    if(!in_array($reseau[0], $listeReseaux)){
                        array_push($listeReseaux, $reseau[0]);
                    }
                }
            }
        }
        
        return $this->render('QTCartographieBundle::mutualisation.html.twig', array(
                                    'liste_reseaux' => $listeReseaux,
                                    'liste_plateformes' => $listePlateformes,
                                    'liste_hyperviseurs' => $listeHyperviseurs,
                                    ));        
    }
    
    /**
     * QT Renvoie les masques de sous réseaux (en /24) de chacune des adresses d'un noeud
     */
    private function getReseaux($noeud)
    {
        $listeAdressesReseau = [$noeud->getIpAdmin(),$noeud->getIpAppli(),$noeud->getIpData()];
        $listeReseaux = Array();
        foreach($listeAdressesReseau as $adresse){
            if(filter_var($adresse, FILTER_VALIDATE_IP)){
                preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}/', $adresse, $res);
                array_push($listeReseaux, $res);
            }
        }
        return $listeReseaux;
    }

}