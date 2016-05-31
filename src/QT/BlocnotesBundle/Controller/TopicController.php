<?php

namespace QT\BlocnotesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TopicController extends Controller
{
    public function afficherTopicAction($num_topic)
    {
        // replace this example code with whatever you need
        return $this->render('QTBlocnotesBundle::topic.html.twig', array('num_topic' => $num_topic));
    }
    
    /**
     * @Route("/edit/{num_topic}", name="topic_edition")
     */ 
    public function editerTopicAction($num_topic)
    {
    	return $this->render('QTBlocnotesBundle::topic_edition.html.twig', array('num_topic' => $num_topic));
    }
}
