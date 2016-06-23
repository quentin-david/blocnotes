<?php

namespace QT\SystemeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use QT\AdminBundle\Entity\Utilisateur;
use QT\SystemeBundle\Entity\Application;

class ApplicationController extends Controller
{
    /**
     * Affichage de la description de l'application de la PF
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $application = $em->getRepository('QTSystemeBundle:Application')->findOneByNom('Blocnotes');
        if($application == null){
            $application = new Application();
        }
        
         //Creation de l'objet formulaire
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $application);
        if($application->getNom() == ''){
            $formBuilder->add('nom',    TextType::class); //Le nom n'est pas modifiable une fois créé
        }
        $formBuilder
            ->add('ipPublique',    TextType::class)
            ->add('description',    TextAreaType::class)
            ->add('responsable',    EntityType::class, array(
                        'class' => 'QTAdminBundle:Utilisateur',
                        'choice_label' => 'username',    
                        ))
            ->add('Valider', SubmitType::class);
            
        $formulaire_application = $formBuilder->getForm();
        
        // Enregistrement de l'utilisateur
        if($request->isMethod('POST')){
            $formulaire_application->handleRequest($request);
            if ($formulaire_application->isSubmitted() && $formulaire_application->isValid()) {
                $em->persist($application);
                $em->flush();
                // redirection
                return $this->redirectToRoute('afficher_application');       
            }
        }
        
        return $this->render('QTSystemeBundle::application.html.twig', array(
                                    'application' => $application,
                                    'formulaire' => $formulaire_application->createView(),
                                    ));
    }
}
