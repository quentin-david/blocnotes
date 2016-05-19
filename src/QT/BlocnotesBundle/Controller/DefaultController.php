<?php

namespace QT\BlocnotesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QTBlocnotesBundle::base.html.twig');
    }
}
