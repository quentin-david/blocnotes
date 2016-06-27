<?php

namespace QT\SystemeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="QT\SystemeBundle\Repository\ApplicationRepository")
 */
class Application
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
    private $responsable;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_publique", type="string", length=20, nullable=true)
     */
    private $ipPublique;

    /**
     * Constructeur (crée l'appli)
     */
    public function __construct()
    {
        $this->nom = "Blocnotes";
        $this->description = "Entrer la description ici";
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Application
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Application
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ipPublique
     *
     * @param string $ipPublique
     *
     * @return Application
     */
    public function setIpPublique($ipPublique)
    {
        $this->ipPublique = $ipPublique;

        return $this;
    }

    /**
     * Get ipPublique
     *
     * @return string
     */
    public function getIpPublique()
    {
        return $this->ipPublique;
    }

    /**
     * Set responsable
     *
     * @param \QT\AdminBundle\Entity\Utilisateur $responsable
     *
     * @return Application
     */
    public function setResponsable(\QT\AdminBundle\Entity\Utilisateur $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \QT\AdminBundle\Entity\Utilisateur
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
}
