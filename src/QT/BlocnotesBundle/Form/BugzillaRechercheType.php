<?php
namespace QT\BlocnotesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use QT\BlocnotesBundle\Form\BugzillaType;

/**
 * Formulaire de recherche de topic
 */
class BugzillaRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            //->add('createur', EntityType::class, array('class' => 'QTAdminBundle:Utilisateur', 'choice_label' => 'username', 'placeholder' => '---', 'empty_data'  => null,'required' => false))
            ->add('application', EntityType::class, array('class' => 'QTCartographieBundle:Application', 'choice_label' => 'nom', 'placeholder' => '---', 'empty_data'  => null,'required' => false))
            ->add('etat', ChoiceType::class, array(
                        'choices' => array(
                            'ouvert' => 'ouvert',
                            'resolu' => 'resolu',
                            'invalide' => 'invalide',
                        ),
                            'placeholder' => '---',
                             'empty_data'  => null,
                             'required' => false,
            ))
            ->add('categorie', ChoiceType::class, array(
                        'choices' => array(
                            'concept' => 'concept',
                            'bug' => 'bug',
                            'amelioration' => 'amelioration',
                        ),
                        'placeholder' => '---',
                        'empty_data'  => null,
                        'required' => false,
            ))
            //->add('bugzilla', BugzillaType::class)
            ->add('rechercher', SubmitType::class)
            ->setMethod('GET');
    }

}