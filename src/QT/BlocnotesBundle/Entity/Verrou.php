<?php

namespace QT\BlocnotesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Verrou
 *
 * @ORM\Table(name="verrou")
 * @ORM\Entity(repositoryClass="QT\BlocnotesBundle\Repository\VerrouRepository")
 */
class Verrou
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="QT\BlocnotesBundle\Entity\Topic", cascade={"persist"})
     */
    private $id_topic;
    
    /**
     * @ORM\OneToOne(targetEntity="QT\AdminBundle\Entity\Utilisateur", cascade={"persist"})
     */
    private $id_utilisateur;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="verrouille", type="boolean")
     */
    private $verrouille;

    /**
     *
     */
    public function __construct()
    {
        $this->date = new \Datetime();
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
     * Set verrouille
     *
     * @param boolean $verrouille
     *
     * @return Verrou
     */
    public function setVerrouille($verrouille)
    {
        $this->verrouille = $verrouille;

        return $this;
    }

    /**
     * Get verrouille
     *
     * @return bool
     */
    public function getVerrouille()
    {
        return $this->verrouille;
    }

    /**
     * Set idTopic
     *
     * @param \QT\BlocnotesBundle\Entity\Topic $idTopic
     *
     * @return Verrou
     */
    public function setIdTopic(\QT\BlocnotesBundle\Entity\Topic $idTopic)
    {
        $this->id_topic = $idTopic;

        return $this;
    }

    /**
     * Get idTopic
     *
     * @return \QT\BlocnotesBundle\Entity\Topic
     */
    public function getIdTopic()
    {
        return $this->id_topic;
    }

    /**
     * Set idUtilisateur
     *
     * @param \QT\AdminBundle\Entity\Utilisateur $idUtilisateur
     *
     * @return Verrou
     */
    public function setIdUtilisateur(\QT\AdminBundle\Entity\Utilisateur $idUtilisateur)
    {
        $this->id_utilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return \QT\AdminBundle\Entity\Utilisateur
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Verrou
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
