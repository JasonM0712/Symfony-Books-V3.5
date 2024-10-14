<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Entity\Emprunt;
use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser(); 
        if (!$user) {
            throw $this->createNotFoundException('No user is logged in.');
        }
        $emprunts = $user->getEmprunts(); 
  
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'emprunts' => $emprunts, 
        ]);
    }

    #[Route('/profile/{id}/identite/edit', name: 'app_profile_identite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher, Utilisateurs $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->remove('email');
        $form->remove('plainPassword');
        $form->remove('roles');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/identite/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
           
        ]);
    }

    #[Route('/profile/{id}/connexion/edit', name: 'app_profile_connexion_edit', methods: ['GET', 'POST'])]
    public function edit2(Request $request, UserPasswordHasherInterface $userPasswordHasher, Utilisateurs $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->remove('roles');
        $form->remove('nom');
        $form->remove('prenom');
        $form->remove('dateNaissance');
        $form->remove('adresse');
        $form->remove('codePostal');
        $form->remove('ville');
        $form->remove('numeroTelephone');
        $form->remove('langueDuSiteFr');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($utilisateur->getPassword() != $form->get('plainPassword')->getData() && $form->get('plainPassword')->getData() != '')
            {
                // encode the plain password
                $utilisateur->setPassword(
                    $userPasswordHasher->hashPassword(
                        $utilisateur,
                        $form->get('plainPassword')->getData()
                    )
                );
            }

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/identite/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
        } 
    }