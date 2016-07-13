<?php

namespace QT\CartographieBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use QT\SystemeBundle\Entity\Noeud;
use QT\SystemeBundle\Form\NoeudType;
use QT\SystemeBundle\Entity\Application;
use QT\CartographieBundle\Entity\Bundle;
use QT\CartographieBundle\Form\BundleType;

class ApplicatifController extends Controller
{
    /**
     * Page d'accueil de la cartographie globale
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeBundles = $em->getRepository('QTCartographieBundle:Bundle')->findAll();
        //$listeBundles = ["SystemeBundle","AdminBundle"];
        return $this->render('QTCartographieBundle::applicatif.html.twig', array(
                                    'liste_bundles' => $listeBundles,
                                    ));        
    }    
        
    
    /**
     * Edition ou création d'un bundle
     */
    public function editerBundleAction(Request $request, $bundle_num = null)
    {
        $em = $this->getDoctrine()->getManager();
        if($bundle_num == ''){
            $bundle = new Bundle();
        }else{
            $bundle = $em->getRepository('QTCartographieBundle:Bundle')->findOneById($bundle_num);
        }
        
        $formulaire = $this->createForm(BundleType::class, $bundle);
        
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $em->persist($bundle);
                $em->flush();
                
                return $this->redirectToRoute('afficher_applicatif');
            }
        }
        
        return $this->render('QTCartographieBundle::bundle_edition.html.twig', array(
                                        'formulaire' => $formulaire->createView(),
                                        ));
    }

}