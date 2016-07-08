<?php

namespace QT\CartographieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hyperviseur
 *
 * @ORM\Table(name="hyperviseur")
 * @ORM\Entity(repositoryClass="QT\CartographieBundle\Repository\HyperviseurRepository")
 */
class Hyperviseur
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
     * @ORM\Column(name="ipPublique", type="string", length=30, unique=true)
     */
    private $ipPublique;

    /**
     * @var int
     *
     * @ORM\Column(name="nbRam", type="integer", nullable=true)
     */
    private $nbRam;


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
     * @return Hyperviseur
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
     * @return Hyperviseur
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
     * @return Hyperviseur
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
     * Set nbRam
     *
     * @param integer $nbRam
     *
     * @return Hyperviseur
     */
    public function setNbRam($nbRam)
    {
        $this->nbRam = $nbRam;

        return $this;
    }

    /**
     * Get nbRam
     *
     * @return int
     */
    public function getNbRam()
    {
        return $this->nbRam;
    }
}

