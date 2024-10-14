<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints\NotNull; 
use Symfony\Component\Validator\Constraints\Range;  
use App\Entity\Livres;
use App\Entity\Auteurs;
use App\Entity\EtatsLivres;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class LivresType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('anneePublication', IntegerType::class, [
                'label' => 'Année de publication',
                'constraints' => [
                    new NotNull([
                        'message' => 'L\'année de publication ne peut pas être vide.',
                    ]),

                    new Range([
                        'min' => 1000,
                        'max' => date('Y'),
                        'notInRangeMessage' => 'L\'année de publication doit être comprise entre {{ min }} et {{ max }}.',
                    ]),
                ],
            ])
            ->add('resume')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'download_label' => 'Télécharger',
                'image_uri' => true,
                'asset_helper' => true,
            ])
            ->add('disponibilite', CheckboxType::class, [
                'label' => 'Disponible',
                'data' => true,
            ])
            ->add('etatsLivres', EntityType::class, [
                'class' => EtatsLivres::class,
                'choice_label' => 'libelle',
            ])
            ->add('auteurs', EntityType::class, [
                'class' => Auteurs::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('Position', IntegerType::class, [
                'label' => 'Position',
                'attr' => ['min' => 1],
                'required' => true,
            ]);

            $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                $livreRepository = $this->entityManager->getRepository(Livres::class);
            
                // Récupérer le livre actuel
                $livre = $form->getData();
                $currentPosition = $livre->getPosition();
                $newPosition = $data['Position'];
            
                // Vérifier si la position a changé
                if ($currentPosition !== $newPosition) {
                    // Réorganiser les positions
                    if ($newPosition > $currentPosition) {
                        $livres = $livreRepository->createQueryBuilder('l')
                            ->where('l.Position > :currentPosition')
                            ->andWhere('l.Position <= :newPosition')
                            ->setParameter('currentPosition', $currentPosition)
                            ->setParameter('newPosition', $newPosition)
                            ->orderBy('l.Position', 'ASC')
                            ->getQuery()
                            ->getResult();
            
                        foreach ($livres as $l) {
                            $l->setPosition($l->getPosition() - 1);
                            $this->entityManager->persist($l);  // On persist les autres livres ici
                        }
                    } else {
                        $livres = $livreRepository->createQueryBuilder('l')
                            ->where('l.Position >= :newPosition')
                            ->andWhere('l.Position < :currentPosition')
                            ->setParameter('currentPosition', $currentPosition)
                            ->setParameter('newPosition', $newPosition)
                            ->orderBy('l.Position', 'DESC')
                            ->getQuery()
                            ->getResult();
            
                        foreach ($livres as $l) {
                            $l->setPosition($l->getPosition() + 1);
                            $this->entityManager->persist($l);  // On persist les autres livres ici
                        }
                    }
            
                    // Mettre à jour la position du livre actuel
                    $livre->setPosition($newPosition);
                    $this->entityManager->persist($livre);  // Ne pas faire de flush ici
                }
            });
    }

    private function renumberPositions(EntityManagerInterface $entityManager)
    {
        $livreRepository = $entityManager->getRepository(Livres::class);
        $livres = $livreRepository->findBy([], ['Position' => 'ASC']);

        $position = 1;
        foreach ($livres as $livre) {
            $livre->setPosition($position);
            $entityManager->persist($livre);
            $position++;
        }

        $entityManager->flush();  // Flush ici pour sauvegarder les nouvelles positions
    }
}
