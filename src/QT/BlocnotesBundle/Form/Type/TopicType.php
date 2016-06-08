<?php
namespace QT\BlocnotesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Formulaire de creation de topic
 */
class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('titre', TextType::class)
			->add('createur', EntityType::class, array('class' => 'QTBlocnotesBundle:Utilisateur', 'choice_label' => 'username'))
			->add('domaine', EntityType::class, array('class' => 'QTBlocnotesBundle:Domaine', 'choice_label' => 'libelle'))
			->add('corps', TextareaType::class)
            ->add('save', SubmitType::class); 
    }
}