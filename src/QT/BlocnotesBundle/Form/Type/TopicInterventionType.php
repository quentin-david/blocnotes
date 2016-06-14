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
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Formulaire de creation de topic de type DI
 */
class TopicInterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('titre', TextType::class)
			->add('domaine', EntityType::class, array('class' => 'QTAdminBundle:Domaine', 'choice_label' => 'libelle'))
            ->add('intervention', InterventionType::class)
			->add('pj', FileType::class)
			->add('corps', TextareaType::class)
            ->add('save', SubmitType::class); 
    }
}