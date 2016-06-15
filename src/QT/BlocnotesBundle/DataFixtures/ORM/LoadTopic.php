<?php

// src/QT/BlocnotesBundle/DataFixtures/ORM/LoadUser.php
namespace QT\BlocnotesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use QT\BlocnotesBundle\Entity\Topic;

class LoadTopic implements FixtureInterface
{
  
  public function load(ObjectManager $manager)
  {
    // On crée l'utilisateur
    $topic = new Topic;

    // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
    $topic->setCreateur(6);
    $topic->setDomaines(array(3));
    $topic->setTitre("Topic automatique Fixture");
    $topic->setCorps("Topic automatique Fixture");
    $topic->setPj('');

    // On le persiste
    $manager->persist($topic);

    // On déclenche l'enregistrement
    $manager->flush();
  }

}