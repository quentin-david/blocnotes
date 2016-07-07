<?php
namespace QT\BlocnotesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use QT\AdminBundle\Form\DomaineType;
use QT\BlocnotesBundle\Form\Type\PieceJointeType;

/**
 * Formulaire de creation de topic
 */
class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('titre', TextType::class)
			//->add('domaine', EntityType::class, array('class' => 'QTAdminBundle:Domaine','choice_label' => 'libelle'))
			->add('domaines', EntityType::class, array(
							'class' => 'QTAdminBundle:Domaine',
							'choice_label' => 'libelle',
							'multiple'     => true,
							//'expanded' => true,
			))
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
	
	/**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QT\BlocnotesBundle\Entity\Topic'
        ));
    }
}