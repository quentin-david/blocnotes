<?php

namespace QT\DocumentsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class DocumentsController extends Controller
{
    public function listerAction()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../../../../web/uploads/photos');
        $liste_documents = Array();
        foreach($finder as $doc){
            array_push($liste_documents, $doc->getRelativePathname());
        }
        return $this->render('QTDocumentsBundle::liste_documents.html.twig', array(
                                    'documents' => $liste_documents,
                             ));
    }
}
