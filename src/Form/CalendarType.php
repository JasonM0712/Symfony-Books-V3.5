<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\SallesTravail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text',
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text',
            ])
            ->add('sallesTravail', EntityType::class, [ // Utilisez EntityType pour les relations d'entités
                'class' => SallesTravail::class, // Spécifiez l'entité à utiliser
                'choice_label' => 'nom', // Le champ de l'entité à afficher dans la liste déroulante
                'multiple' => false, // Pour permettre à l'utilisateur de sélectionner plusieurs salles
                'expanded' => true, // Pour afficher les cases à cocher comme des boutons radio
            ])
            ->add('salles_travail_id', HiddenType::class, [
                'mapped' => false, // N'est pas lié à une propriété de l'entité
                'attr' => [
                    'class' => 'hidden-salles-travail-id' // Ajoutez une classe CSS pour identifier ce champ caché
                ]
            ])

            ->add('description')
            ->add('all_day')
            ->add('background_color', ColorType::class )
            ->add('text_color', ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
