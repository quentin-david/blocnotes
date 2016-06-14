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

use QT\AdminBundle\Form\ProfilType;

class ProfilController extends Controller
{
    /**
     * 
     */
    public function indexAction(Request $request)
    {
        //Entity Manager
        $em = $this->getDoctrine()->getManager();
        
        $username = $this->getUser()->getUsername();
        
        // Objet Emplacement pour le formulaire
        $utilisateur = $em->getRepository('QTAdminBundle:Utilisateur')->findOneBy(array('username' => $username));
        
        //Creation de l'objet formulaire
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $utilisateur);
        $formBuilder
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('modifier', SubmitType::class);       
        $formulaire_password = $formBuilder->getForm();
        
        //Creation de l'objet formulaire
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $utilisateur);
        $formBuilder
            ->add('profil', ProfilType::class)
            ->add('modifier', SubmitType::class);       
        $formulaire_profil = $formBuilder->getForm();
        
        // Enregistrement de l'utilisateur
        if($request->isMethod('POST')){
            $formulaire_password->handleRequest($request);
            if ($formulaire_password->isSubmitted() && $formulaire_password->isValid()) {
    
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $this->get('security.password_encoder')->encodePassword($utilisateur, $utilisateur->getPlainPassword());
                $utilisateur->setPassword($password);

                // 4) save the User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
    
                // ... do any other work - like sending them an email, etc
                return $this->redirectToRoute('profil');
            }
        }
        
        // Execution du template d'affichage
        return $this->render('QTAdminBundle::profil.html.twig', array(
                                        'formulaire_profil' => $formulaire_profil->createView(),
                                        'formulaire_password' => $formulaire_password->createView(),
                                        'utilisateur' => $utilisateur,
                                        //'profil' => $profil
                            ));
    }

}