<?php

namespace QT\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="QT\AdminBundle\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface, \Serializable
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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=100, unique=true)
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;
    
    /**
    * @ORM\Column(name="roles", type="array")
    */
    private $roles = array();
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $listeRoles;

    /**
     * @ORM\OneToOne(targetEntity="QT\AdminBundle\Entity\Profil", cascade={"persist"})
     */
    private $profil;
    

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
     * @return Utilisateur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }
    
    /**
     * QT essai pour transformer liste de roles en un tableau
     */
    public function getListeRoles()
    {
        return $this->listeRoles;
        //return implode(",", $this->roles);
    }

    public function setListeRoles($listeRoles)
    {
        $this->listeRoles = $listeRoles;
    }
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        if($password != ''){
            $this->password = $password;
        }

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getRoles()
    {
        return $this->roles;
        //return array('ROLE_USER','ROLE_ADMIN');
    }
    
    public function getSalt()
    {
        return null;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function eraseCredentials()
    {
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return Utilisateur
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }
    
    /**
     * QT essai 
     */
    public function __toString()
    {
        return (string) $this->getUsername();
    }

    /**
     * Set profil
     *
     * @param \QT\AdminBundle\Entity\Profil $profil
     *
     * @return Utilisateur
     */
    public function setProfil(\QT\AdminBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \QT\AdminBundle\Entity\Profil
     */
    public function getProfil()
    {
        return $this->profil;
    }
}
