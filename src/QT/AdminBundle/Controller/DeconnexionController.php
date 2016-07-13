<?php
namespace QT\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;

class DeconnexionController extends Controller
{
    
    /**
     * Deconnexion de force !
     */
    public function deconnecterAction(Request $request){
        $this->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();
        
        return $this->redirectToRoute('accueil');
    }

}