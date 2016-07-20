<?php

namespace QT\BlocnotesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bugzilla
 *
 * @ORM\Table(name="bugzilla")
 * @ORM\Entity(repositoryClass="QT\BlocnotesBundle\Repository\BugzillaRepository")
 */
class Bugzilla
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
     * @ORM\ManyToOne(targetEntity="QT\CartographieBundle\Entity\Application")
     */
    private $application;
    
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="corps", type="text", nullable=true)
     */
    private $corps;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateResolution", type="datetime", nullable=true)
     */
    private $dateResolution;
    
    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=20, nullable=true)
     */
    private $etat;

    
    /**
     *
     */
    public function __construct()
    {
        $this->dateCreation = new \Datetime();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Bugzilla
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
     * @return Bugzilla
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Bugzilla
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
     * Set dateResolution
     *
     * @param \DateTime $dateResolution
     *
     * @return Bugzilla
     */
    public function setDateResolution($dateResolution)
    {
        $this->dateResolution = $dateResolution;

        return $this;
    }

    /**
     * Get dateResolution
     *
     * @return \DateTime
     */
    public function getDateResolution()
    {
        return $this->dateResolution;
    }

    /**
     * Set createur
     *
     * @param \QT\AdminBundle\Entity\Utilisateur $createur
     *
     * @return Bugzilla
     */
    public function setCreateur(\QT\AdminBundle\Entity\Utilisateur $createur = null)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return \QT\AdminBundle\Entity\Utilisateur
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Set application
     *
     * @param \QT\CartographieBundle\Entity\Application $application
     *
     * @return Bugzilla
     */
    public function setApplication(\QT\CartographieBundle\Entity\Application $application = null)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Get application
     *
     * @return \QT\CartographieBundle\Entity\Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Bugzilla
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
