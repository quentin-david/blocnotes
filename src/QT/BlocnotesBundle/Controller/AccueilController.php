<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use QT\BlocnotesBundle\Entity\Topic;
use QT\BlocnotesBundle\Entity\Domaine;

class AccueilController extends Controller
{
    /**
     * 
     */
    public function indexAction()
    {
        return $this->render('QTBlocnotesBundle::accueil.html.twig');
    }
}
