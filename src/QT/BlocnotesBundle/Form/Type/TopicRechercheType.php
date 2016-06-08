<?php
namespace QT\BlocnotesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Formulaire de recherche de topic
 */
class TopicRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('createur', EntityType::class, array('class' => 'QTBlocnotesBundle:Topic', 'choice_label' => 'createur', 'placeholder' => '---', 'empty_data'  => null,'required' => false))
            ->add('domaine', EntityType::class, array('class' => 'QTBlocnotesBundle:Domaine', 'choice_label' => 'libelle', 'placeholder' => '---', 'empty_data'  => null,'required' => false))
            ->add('rechercher', SubmitType::class)
            ->setMethod('GET');
    }
}