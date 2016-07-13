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
    
    
}