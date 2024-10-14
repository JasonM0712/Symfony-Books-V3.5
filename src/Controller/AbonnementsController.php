<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Entity\TypeAbonnement;
use App\Form\UtilisateursType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeAbonnementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AbonnementsController extends AbstractController
{
    #[Route('/abonnements', name: 'app_abonnements', methods: ['GET'])]
    public function index(TypeAbonnementRepository $abonnementRepository): Response
    {
        return $this->render('abonnements/index.html.twig', [
            'type_abonnements' => $abonnementRepository->findAll(),
        ]);
    }
}