<?php

namespace App\Controller;

use App\Entity\TypeAbonnement;
use App\Form\TypeAbonnementType;
use App\Repository\TypeAbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/abonnement')]
class TypeAbonnementController extends AbstractController
{
    #[Route('/', name: 'app_type_abonnement_index', methods: ['GET'])]
    public function index(TypeAbonnementRepository $typeAbonnementRepository): Response
    {
        return $this->render('type_abonnement/index.html.twig', [
            'type_abonnements' => $typeAbonnementRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_abonnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeAbonnement $typeAbonnement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeAbonnementType::class, $typeAbonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->flush();

            return $this->redirectToRoute('app_type_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_abonnement/edit.html.twig', [
            'type_abonnement' => $typeAbonnement,
            'form' => $form,
        ]);
    }
}
