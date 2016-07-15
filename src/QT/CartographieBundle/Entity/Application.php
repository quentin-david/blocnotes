<?php

namespace QT\CartographieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="QT\CartographieBundle\Repository\ApplicationRepository")
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
     *
     * @ORM\OneToMany(targetEntity="QT\CartographieBundle\Entity\Noeud", mappedBy="application")
     */
    private $noeuds;

    /**
     * Constructeur (crée l'appli)
     */
    public function __construct()
    {
        //$this->nom = "Blocnotes";
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
     * Add noeud
     *
     * @param \QT\CartographieBundle\Entity\Noeud $noeud
     *
     * @return Application
     */
    public function addNoeud(\QT\CartographieBundle\Entity\Noeud $noeud)
    {
        $this->noeuds[] = $noeud;

        return $this;
    }

    /**
     * Remove noeud
     *
     * @param \QT\CartographieBundle\Entity\Noeud $noeud
     */
    public function removeNoeud(\QT\CartographieBundle\Entity\Noeud $noeud)
    {
        $this->noeuds->removeElement($noeud);
    }

    /**
     * Get noeuds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNoeuds()
    {
        return $this->noeuds;
    }
}
