<?php

// src/QT/BlocnotesBundle/DataFixtures/ORM/LoadUser.php
namespace QT\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use QT\AdminBundle\Entity\Utilisateur;

class LoadUser implements FixtureInterface
{
  
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $listNames = array('david');

    foreach ($listNames as $name) {
      // On crée l'utilisateur
      $user = new Utilisateur;

      // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
      $user->setUsername($name);
      $user->setNom($name);
      $user->setLogin($name);
      $user->setPrenom($name);
      $user->setPassword($name);

      // On ne se sert pas du sel pour l'instant
      //$user->setSalt('');

      // On définit uniquement le role ROLE_USER qui est le role de base
      $user->setRoles(array('ROLE_ADMIN'));

      // On le persiste
      $manager->persist($user);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }

}