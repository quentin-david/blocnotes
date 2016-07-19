<?php

namespace QT\DeploiementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LibvirtController extends Controller
{
    public function indexAction()
    {
        $conn = \libvirt_connect('null', false);
        $doms = \libvirt_list_domains($conn);
        return $this->render('QTDeploiementBundle::libvirt.html.twig',array(
                                                 'data' => $doms,                           
                                            ));
    }
}
