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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Formulaire de creation de topic de type DI
 */
class TopicInterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('titre', TextType::class)
			->add('domaines', EntityType::class, array(
							'class' => 'QTAdminBundle:Domaine',
							'choice_label' => 'libelle',
							'multiple'     => true,
							//'expanded' => true,
			))
            ->add('intervention', InterventionType::class)
			->add('pjs', CollectionType::class, array(
				'entry_type'   => PieceJointeType::class,
				'allow_add'    => true,
				'allow_delete' => true,
				'required' => false,
				'by_reference' => false
			))
			->add('corps', TextareaType::class)
            ->add('save', SubmitType::class); 
    }
}