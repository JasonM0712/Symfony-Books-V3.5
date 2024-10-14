<?php

namespace App\Controller;

use App\Entity\SallesTravail;
use App\Form\SallesTravailType;
use App\Repository\SallesTravailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/salles/travail')]
class SallesTravailController extends AbstractController
{

    #[Route('/', name: 'app_salles_travail_index', methods: ['GET'])]
    public function index(SallesTravailRepository $sallesTravailRepository): Response
    {
        return $this->render('salles_travail/index.html.twig',[
            'salles_travails' => $sallesTravailRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_salles_travail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sallesTravail = new SallesTravail();
        $form = $this->createForm(SallesTravailType::class, $sallesTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sallesTravail);
            $entityManager->flush();

            return $this->redirectToRoute('app_salles_travail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salles_travail/new.html.twig', [
            'salles_travail' => $sallesTravail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salles_travail_show', methods: ['GET'])]
    public function show(SallesTravail $sallesTravail): Response
    {
        return $this->render('salles_travail/show.html.twig', [
            'salles_travail' => $sallesTravail,
        ]);
    }

    #[Route('salles/travail/{id}/edit', name: 'app_salles_travail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SallesTravail $sallesTravail, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SallesTravailType::class, $sallesTravail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_salles_travail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salles_travail/edit.html.twig', [
            'salles_travail' => $sallesTravail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salles_travail_delete', methods: ['POST'])]
    public function delete(Request $request, SallesTravail $sallesTravail, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sallesTravail->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($sallesTravail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_salles_travail_index', [], Response::HTTP_SEE_OTHER);
    }
}
