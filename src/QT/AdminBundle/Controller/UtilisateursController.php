<?php
namespace QT\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\AdminBundle\Entity\Utilisateur;
use QT\AdminBundle\Form\UtilisateurType;

class UtilisateursController extends Controller
{
    /**
     * 
     */
    public function indexAction(Request $request, $utilisateur_num = null)
    {
        //Entity Manager
        $em = $this->getDoctrine()->getManager();
        $liste_utilisateurs = $em->getRepository('QTAdminBundle:Utilisateur')->findAll();
        
        // Objet Emplacement pour le formulaire
        if($utilisateur_num == ''){
            $utilisateur = new Utilisateur();
        }else{
            $utilisateur = $em->getRepository('QTAdminBundle:Utilisateur')->find($utilisateur_num);
        }
        
        //Creation de l'objet formulaire
        $formulaire_utilisateur = $this->createForm(UtilisateurType::class, $utilisateur);
        
        // Enregistrement de l'utilisateur
        if($request->isMethod('POST')){
            $formulaire_utilisateur->handleRequest($request);
            if ($formulaire_utilisateur->isSubmitted() && $formulaire_utilisateur->isValid()) {
    
                // MDP de passe temporaire par défaut à la création de l'utilisateur
                if($utilisateur_num == ''){
                    $password = $this->get('security.password_encoder')->encodePassword($utilisateur, "pass");
                    $utilisateur->setPassword($password);
                }
                
                // Ajout du role
                $utilisateur->setRoles(explode(",", $utilisateur->getListeRoles()));
        
                // 4) save the User!
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
    
                // redirection
                return $this->redirectToRoute('creer_utilisateur');
            }
        }
        
        // Execution du template d'affichage
        return $this->render('QTAdminBundle::utilisateurs.html.twig', array(
                                        'utilisateur' => $utilisateur,
                                        'liste_utilisateurs' => $liste_utilisateurs,
                                        'formulaire_utilisateur' => $formulaire_utilisateur->createView()
                            ));
    }
    
    
    /**
     * Suppression d'un utilisateur par son ID
     */
    public function supprimerUtilisateurAction(Request $request,$utilisateur_num)
    {
        //Entity Manager
        $em = $this->getDoctrine()->getManager();
		$utilisateur_a_supprimer = $em->getRepository('QTAdminBundle:Utilisateur')->find($utilisateur_num);
        
        // Verification que le topic existe bien
		if($request->isMethod('POST')){
			//$topic_a_supprimer = $em->getRepository('QTBlocnotesBundle:Topic')->find($topic_num);
			if($utilisateur_a_supprimer != ''){
				$em->remove($utilisateur_a_supprimer);
				$em->flush();
			}
			return $this->redirectToRoute('creer_utilisateur');
		}
			// Affichage du message de confirmation
            return $this->render('QTAdminBundle::utilisateur_suppression.html.twig',array('utilisateur' => $utilisateur_a_supprimer));
    }
    
    public function logoutAction(Request $request)
    {
        /*$session = $request->getSession();
        $session->clear();
        return $this->redirectToRoute('accueil');*/
    }
}