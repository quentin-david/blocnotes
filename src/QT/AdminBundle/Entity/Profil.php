<?php

namespace QT\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profil
 *
 * @ORM\Table(name="profil")
 * @ORM\Entity(repositoryClass="QT\AdminBundle\Repository\ProfilRepository")
 */
class Profil
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
     * @var bool
     *
     * @ORM\Column(name="afficherDi", type="boolean")
     */
    private $afficherDi;


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
     * Set afficherDi
     *
     * @param boolean $afficherDi
     *
     * @return Profil
     */
    public function setAfficherDi($afficherDi)
    {
        $this->afficherDi = $afficherDi;

        return $this;
    }

    /**
     * Get afficherDi
     *
     * @return bool
     */
    public function getAfficherDi()
    {
        return $this->afficherDi;
    }
}

