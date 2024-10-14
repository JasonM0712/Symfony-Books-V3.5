<?php

namespace App\Form;

use App\Entity\Notes;
use App\Entity\Livres;
use App\Entity\Utilisateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NotesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'label' => 'Note (de 1 à 5)',
            ])
            ->add('utilisateurs', EntityType::class, [
                'class' => Utilisateurs::class,
                'choice_label' => 'id',
                'attr' => [
                    'style' => 'display: none;',
                ],
                'label' => false
            ])
            ->add('livres', EntityType::class, [
                'class' => Livres::class,
                'choice_label' => 'id',
                'attr' => [
                    'style' => 'display: none;',
                ],
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Notes::class,
        ]);
    }
}
