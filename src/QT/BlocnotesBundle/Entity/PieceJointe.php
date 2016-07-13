<?php

namespace QT\BlocnotesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * PieceJointe
 *
 * @ORM\Table(name="piece_jointe")
 * @ORM\Entity(repositoryClass="QT\BlocnotesBundle\Repository\PieceJointeRepository")
 */
class PieceJointe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="QT\BlocnotesBundle\Entity\Topic", inversedBy="pjs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $topic;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;
    
    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=25, nullable=true)
     */
    private $extension;

    private $file;
    
    
    /**
     *  Constructeur
     */
    public function __construct()
    {
        $this->url = md5(rand()); //Identifiant aleatoire
        //$this->alt = $this->file->getClientOriginalName();
    }
    
    
    /**
     * QT fonction upload
     */
    public function uploadFile()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
          return;
        }        
        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move($this->getUploadDir(), $this->url);
    }
    
    public function deleteFile()
    {
        if($this->getUrl() != null){
            unlink($this->getUploadDir().'/'.$this->getUrl());
        }
    }
    
      
    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
        return __DIR__.'/../../../../web/uploads/topic_pj';
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getUrl();
        // Permet de l'inserer facilement dans les pages apres
        // src="{{ asset(advert.image.webPath) }}"
    }
    
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return PieceJointe
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return PieceJointe
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    
    
    // On modifie le setter de File, pour prendre en compte l'upload d'un fichier
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
        $this->alt = $this->file->getClientOriginalName();
        //Calcul et enregistrement de l'extension du fichier
        $extension = $this->file->guessExtension();
        if(!$extension){$extension = 'bin';}
        $this->extension = $extension;
        $this->uploadFile();
    }


    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set topic
     *
     * @param \QT\BlocnotesBundle\Entity\Topic $topic
     *
     * @return PieceJointe
     */
    public function setTopic(\QT\BlocnotesBundle\Entity\Topic $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \QT\BlocnotesBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return PieceJointe
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }
}
