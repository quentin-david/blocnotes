<?php
namespace QT\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use QT\AdminBundle\Entity\Domaine;
use Symfony\Component\HttpFoundation\Request;
use QT\AdminBundle\Form\DomaineType;

class DomaineController extends Controller
{
    /*
     * Affichage de la liste du formulaire de type $form et de la liste des objets existant
     * Famille de formulaires : Type_cartouche, projet, type_localisation
     * Enregistrement de l'objet en base
     */
    public function editerDomaineAction(Request $request, $domaine_num=null)
    {
        //ENtity Manager
        $em = $this->getDoctrine()->getManager();

        if($domaine_num == null){
            $domaine = new Domaine;
        }else{
            $domaine = $em->getRepository('QTAdminBundle:Domaine')->find($domaine_num);
        }
        
        $formulaire = $this->createForm(DomaineType::class,$domaine);
         
        // Liste les domaines
        $liste_domaines = $em->getRepository('QTAdminBundle:Domaine')->findAll();
        
        //Enregistrement en base
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isValid()){
                $em->persist($domaine);
                $em->flush();
                
                return $this->redirectToRoute('creer_domaine');
            }
        }
        
        //Génération du template
        return $this->render('QTAdminBundle::domaine.html.twig', array(
                                    'formulaire' => $formulaire->createView(),
                                    'liste_domaines' =>$liste_domaines
                            ));
    }
    
    /**
     * Suppression d'un domaine
     * Vérification des topics impactés
     */
    public function supprimerDomaineAction(Request $request, $domaine_num)
    {
        $em = $this->getDoctrine()->getManager();
        $domaine_a_supprimer = $em->getRepository('QTAdminBundle:Domaine')->find($domaine_num);
        if($domaine_a_supprimer == null){
            return 1;
        }
        
        if($request->isMethod('POST')){
            foreach($domaine_a_supprimer->getTopics() as $topic_concerne){
                if(sizeof($topic_concerne->getDomaines()) < 2){
                    //Si le topic n'a plus de domaine on lui rajoute le "Perso"
                    $topic_concerne->addDomaine($em->getRepository('QTAdminBundle:Domaine')->find(4));
                }
                $topic_concerne->removeDomaine($domaine_a_supprimer);
            }
            $em->remove($domaine_a_supprimer);
            $em->flush();
            
            return $this->redirectToRoute('creer_domaine');
        }
        
        return $this->render('QTAdminBundle::domaine_suppression.html.twig', array(
                                            'domaine' => $domaine_a_supprimer
                                            ));
    }
}