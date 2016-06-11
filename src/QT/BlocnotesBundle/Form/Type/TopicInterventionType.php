<?php
namespace QT\BlocnotesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DatetimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use QT\BlocnotesBundle\Form\Type\InterventionType;

/**
 * Formulaire de creation de topic de type DI
 */
class TopicInterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('titre', TextType::class)
			->add('createur', EntityType::class, array('class' => 'QTAdminBundle:Utilisateur', 'choice_label' => 'username'))
			->add('domaine', EntityType::class, array('class' => 'QTAdminBundle:Domaine', 'choice_label' => 'libelle'))
            ->add('intervention', InterventionType::class)
			->add('corps', TextareaType::class)
            ->add('save', SubmitType::class); 
    }
}