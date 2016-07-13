<?php

namespace QT\SystemeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use QT\BlocnotesBundle\Form\Type\PieceJointeType;
use QT\SystemeBundle\Form\Type\Application;

class NoeudType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('hyperviseur', EntityType::class, array(
							'class' => 'QTCartographieBundle:Hyperviseur',
							'choice_label' => 'nom',
			))
            ->add('description')
			->add('etat')
            ->add('descriptionCourte')
			->add('os')
            ->add('ipAdmin')
            ->add('ipData')
            ->add('ipAppli')
            ->add('mac')
            ->add('nbCpu')
            ->add('nbRam')
			->add('nbDisque')
            ->add('Valider', SubmitType::class);
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QT\SystemeBundle\Entity\Noeud'
        ));
    }
}
