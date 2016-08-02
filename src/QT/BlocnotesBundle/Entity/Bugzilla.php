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
     * @ORM\OneToOne(targetEntity="QT\BlocnotesBundle\Entity\Topic", cascade={"persist"})
     */
    //private $topic;
    
    /**
     * @ORM\ManyToOne(targetEntity="QT\CartographieBundle\Entity\Application")
     */
    private $application;

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
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=20, nullable=true)
     */
    private $categorie;

    
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

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Bugzilla
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
