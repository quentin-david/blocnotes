<?php
namespace QT\AdminBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\AdminBundle\Entity\Utilisateur;

class UtilisateursController extends Controller
{
    /**
     * 
     */
    public function indexAction(Request $request)
    {
        //Entity Manager
        $em = $this->getDoctrine()->getManager();
        $liste_utilisateurs = $em->getRepository('QTAdminBundle:Utilisateur')->findAll();
        
        // Objet Emplacement pour le formulaire
        $utilisateur = new Utilisateur();
        
        //Creation de l'objet formulaire
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $utilisateur);
        $formBuilder
            ->add('nom',    TextType::class)
            ->add('prenom',    TextType::class)
            ->add('trigramme',    TextType::class)
            ->add('nomAffiche',    TextType::class)
            ->add('username',    TextType::class)
            ->add('roles',  CollectionType::class )
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('rechercher', SubmitType::class);   
        $formulaire_utilisateur = $formBuilder->getForm();
        
        // Enregistrement de l'utilisateur
        if($request->isMethod('POST')){
            $formulaire_utilisateur->handleRequest($request);
            if ($formulaire_utilisateur->isSubmitted() && $formulaire_utilisateur->isValid()) {
    
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $this->get('security.password_encoder')
                        ->encodePassword($utilisateur, $utilisateur->getPlainPassword());
                $utilisateur->setPassword($password);
    
                // 4) save the User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
    
                // ... do any other work - like sending them an email, etc
                return $this->redirectToRoute('utilisateurs');
            }
        }
        
        // Execution du template d'affichage
        return $this->render('QTAdminBundle::utilisateurs.html.twig', array(
                                        'liste_utilisateurs' => $liste_utilisateurs,
                                        'formulaire_utilisateur' => $formulaire_utilisateur->createView()
                            ));
    }
}