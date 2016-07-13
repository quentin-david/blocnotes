<?php

namespace QT\BlocnotesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="QT\BlocnotesBundle\Repository\TopicRepository")
 */
class Topic
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
     * @ORM\ManyToOne(targetEntity="QT\AdminBundle\Entity\Utilisateur")
     */
    private $createur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var text
     *
     * @ORM\Column(name="corps", type="text")
     */
    private $corps;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime")
     */
    private $dateModification;

    /**
     * @ORM\ManyToMany(targetEntity="QT\AdminBundle\Entity\Domaine", cascade={"persist"}, inversedBy="topics")
     * @ORM\JoinTable(name="topic_domaine")
     */
    private $domaines;
    
    /**
     * @ORM\OneToOne(targetEntity="QT\BlocnotesBundle\Entity\Intervention", cascade={"persist"})
     */
    private $intervention;
    
    /**
     * @ORM\OneToMany(targetEntity="QT\BlocnotesBundle\Entity\PieceJointe", mappedBy="topic", cascade={"persist"})
     */
    private $pjs;

    
    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->dateCreation = new \Datetime();
        $this->dateModification = new \Datetime();
        
        $this->domaines = new ArrayCollection();
        $this->pjs = new ArrayCollection();
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Topic
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Topic
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set corps
     *
     * @param string $corps
     *
     * @return Topic
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Topic
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }



    /**
     * Set createur
     *
     * @param \QT\BlocnotesBundle\Entity\Utilisateur $createur
     *
     * @return Topic
     */
    public function setCreateur(\QT\AdminBundle\Entity\Utilisateur $createur = null)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return \QT\BlocnotesBundle\Entity\Utilisateur
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Set intervention
     *
     * @param \QT\BlocnotesBundle\Entity\Intervention $intervention
     *
     * @return Intervention
     */
    public function setIntervention(\QT\BlocnotesBundle\Entity\Intervention $intervention = null)
    {
        $this->intervention = $intervention;

        return $this;
    }

    /**
     * Get intervention
     *
     * @return \QT\BlocnotesBundle\Intervention
     */
    public function getIntervention()
    {
        return $this->intervention;
    }


    /**
     * Add domaine
     *
     * @param \QT\AdminBundle\Entity\Domaine $domaine
     *
     * @return Topic
     */
    public function addDomaine(\QT\AdminBundle\Entity\Domaine $domaine)
    {
        $this->domaines[] = $domaine;

        return $this;
    }

    /**
     * Remove domaine
     *
     * @param \QT\AdminBundle\Entity\Domaine $domaine
     */
    public function removeDomaine(\QT\AdminBundle\Entity\Domaine $domaine)
    {
        $this->domaines->removeElement($domaine);
    }

    /**
     * Get domaines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomaines()
    {
        return $this->domaines;
    }

    /**
     * Add pj
     *
     * @param \QT\BlocnotesBundle\Entity\PieceJointe $pj
     *
     * @return Topic
     */
    public function addPj(\QT\BlocnotesBundle\Entity\PieceJointe $pj)
    {
        $this->pjs[] = $pj;
        
        //QT
        $pj->setTopic($this);

        return $this;
    }

    /**
     * Remove pj
     *
     * @param \QT\BlocnotesBundle\Entity\PieceJointe $pj
     */
    public function removePj(\QT\BlocnotesBundle\Entity\PieceJointe $pj)
    {
        $this->pjs->removeElement($pj);
    }

    /**
     * Get pjs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPjs()
    {
        return $this->pjs;
    }
    
}
