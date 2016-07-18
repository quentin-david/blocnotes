<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\CartographieBundle\Entity\Hyperviseur;
use QT\CartographieBundle\Form\HyperviseurType;

class HyperviseurController extends Controller
{
    /**
     * Afficher la page hyperviseur
     */
    public function afficherHyperviseurAction($hyperviseur_num)
    {
        $em = $this->getDoctrine()->getManager();
        $hyperviseur = $em->getRepository('QTCartographieBundle:Hyperviseur')->find($hyperviseur_num);
        $listeReseaux = Array();
        //Bricolage pour avoir les réseaux d'un hyperviseur
        foreach($hyperviseur->getNoeuds() as $noeud){
            foreach($this->getReseaux($noeud) as $reseau){
                if(!in_array($reseau[0], $listeReseaux)){
                    array_push($listeReseaux, $reseau[0]);
                }
            }
        }
        
        return $this->render('QTCartographieBundle::hyperviseur.html.twig', array(
                                            'liste_reseaux' => $listeReseaux,
                                            'hyperviseur' => $hyperviseur,                                      
                                        ));
    }
    
    
    /**
     * Edition ou création d'un hyperviseur
     */
    public function editerHyperviseurAction(Request $request, $hyperviseur_num = null)
    {
        $em = $this->getDoctrine()->getManager();
        if($hyperviseur_num == ''){
            $hyperviseur = new Hyperviseur();
        }else{
            $hyperviseur = $em->getRepository('QTCartographieBundle:Hyperviseur')->findOneById($hyperviseur_num);
        }
        
        $formulaire = $this->createForm(HyperviseurType::class, $hyperviseur);
        
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $em->persist($hyperviseur);
                $em->flush();
                
                return $this->redirectToRoute('afficher_mutualisation');
            }
        }
        
        return $this->render('QTCartographieBundle::hyperviseur_edition.html.twig', array(
                                        'formulaire' => $formulaire->createView(),
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