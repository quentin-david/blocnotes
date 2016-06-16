<?php
namespace QT\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use QT\AdminBundle\Entity\Domaine;
use Symfony\Component\HttpFoundation\Request;

class DomaineController extends Controller
{
    /*
     * Affichage de la liste du formulaire de type $form et de la liste des objets existant
     * Famille de formulaires : Type_cartouche, projet, type_localisation
     * Enregistrement de l'objet en base
     */
    public function indexAction(Request $request)
    {
        //ENtity Manager
        $em = $this->getDoctrine()->getManager();
        
        // Objet Emplacement pour le formulaire
        $domaine = new Domaine;
        
        //Creation de l'objet formulaire
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $domaine);
        $formBuilder
            ->add('libelle', TextType::class, array('attr'=> array('value'=>'')))
            ->add('save', SubmitType::class);   
        $formulaire = $formBuilder->getForm();
         
        // Liste les domaines
        $liste_domaines = $em->getRepository('QTAdminBundle:Domaine')->findAll();        
        
        //Enregistrement en base
        if($request->isMethod('POST')){
            $formulaire->handleRequest($request);
            if($formulaire->isValid()){
                $em->persist($domaine);
                $em->flush();
                
                return $this->redirectToRoute('ajouter_domaine');
            }
        }
        
        
        //Génération du template
        return $this->render('QTAdminBundle::domaine.html.twig', array(
                                    'formulaire' => $formulaire->createView(),
                                    'liste_domaines' =>$liste_domaines
                            ));
    }   
}