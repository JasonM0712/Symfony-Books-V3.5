<?php

namespace App\Form;

use App\Entity\Equipements;
use App\Entity\SallesTravail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SallesTravailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //ajouter equipement dans le formulaire
        $builder
            ->add('nom', null, [
                'label' => 'Nom de la salle'
            ])
            ->add('capacite' , null, [
                'label' => 'Capacité de la salle'
            ])
            ->add('disponibilite'
            , null, [
                'label' => 'Disponibilité de la salle'
            ])
            ->add('description', null, [
                'label' => 'Description de la salle'
            ])
            ->add('wifi', CheckboxType::class, [
                'label' => 'Wifi',
                'required' => false
            ])
            ->add('projecteur', CheckboxType::class, [
                'label' => 'Projecteur',
                'required' => false
            ])
            ->add('tableau', CheckboxType::class, [
                'label' => 'Tableau',
                'required' => false
            ])
            ->add('priseElectrique', CheckboxType::class, [
                'label' => 'Prise Electrique',
                'required' => false
            ])
            ->add('television', CheckboxType::class, [
                'label' => 'Télévision',
                'required' => false
            ])
            ->add('climatisation', CheckboxType::class, [
                'label' => 'Climatisation',
                'required' => false
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la salle',
                'required' => false,
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SallesTravail::class,
        ]);
    }
}
