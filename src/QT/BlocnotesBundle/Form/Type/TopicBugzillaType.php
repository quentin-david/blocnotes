<?php
namespace QT\BlocnotesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DatetimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use QT\BlocnotesBundle\Form\BugzillaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Formulaire de creation de topic de type DI
 */
class TopicBugzillaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('titre', TextType::class)
            ->add('bugzilla', BugzillaType::class)
			->add('corps', TextareaType::class)
            ->add('save', SubmitType::class); 
    }
}