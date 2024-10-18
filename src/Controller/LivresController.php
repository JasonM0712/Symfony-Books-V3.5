<?php

namespace App\Controller;

use App\Entity\Livres;
use App\DTO\SearchData;
use App\Entity\Emprunts;
use App\Form\LivresType;
use Psr\Log\LoggerInterface;
use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\LivresRepository;
use App\Repository\EmpruntsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/livres')]
class LivresController extends AbstractController
{
    #[Route('/', name: 'app_livres_index', methods: ['GET'])]
    public function bibliotheque(LivresRepository $livreRepository, Request $request): Response
    {
        // Utilise le repository pour obtenir tous les livres
        $livre = $livreRepository->createQueryBuilder('l'); 
    
        $page = $request->query->getInt('page', 1);
        $limite = 9;
        $pagerfanta = $livreRepository->findAllPaginated($page, $limite);  

        return $this->render('livres/index.html.twig', [
            'pager' => $pagerfanta,
            'livres' => $pagerfanta->getCurrentPageResults(), // Ajoute cette ligne pour passer les livres
        ]);
    }
    
    #[Route('/new', name: 'app_livres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $positionMax = $entityManager->getRepository(Livres::class)->findPositionMax();
            $livre->setPosition($positionMax + 1);

            
            $entityManager->persist($livre);
            $entityManager->flush(); 

            return $this->redirectToRoute('app_livres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livres/new.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/show', name: 'app_livres_show', methods: ['GET'])]
    public function show(Livres $livre): Response
    {
        return $this->render('livres/show.html.twig', [
            'livre' => $livre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_livres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livres $livre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivresType::class, $livre);
        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livre);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_livres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livres/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_livres_delete', methods: ['POST'])]
    public function delete(Request $request, Livres $livre, EntityManagerInterface $entityManager): Response
    {
         if (!$livre) {
            throw $this->createNotFoundException('Le livre n\'existe pas.');
        } 

        if ($this->isCsrfTokenValid('delete' . $livre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livre);
            $entityManager->flush();
        }
         else {
            throw new InvalidCsrfTokenException('Token CSRF invalide.');
        }

        return $this->redirectToRoute('app_livres_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('en_retard', name: 'app_en_retard', methods: ['GET'])]
    public function livresEnRetard(EntityManagerInterface $entityManager): Response
    {
        $empruntsRepository = $entityManager->getRepository(Emprunts::class);
        $empruntsEnRetard = $empruntsRepository->findLivresEnRetard();

        return $this->render('livres/en_retard.html.twig', [
            'empruntsEnRetard' => $empruntsEnRetard
        ]);
    }

    #[Route('/livres/html2pdf', name: 'app_html2pdf', methods: ['GET'])]
    public function html2pdf(LivresRepository $livreRepository): Response
    {
        
        try {

            $livres = $livreRepository->findBy([],['Position'=>'ASC']);
            $htmlContent = $this->renderView('livres/pdf.html.twig', [
                'livres' => $livres,
            ]);
            
            // $imageBase64 = base64_encode_image('/public/images/livres/');

            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($htmlContent);
            $html2pdf->output();
    
            return new Response('', Response::HTTP_OK, ['Content-Type' => 'application/pdf']);

        } catch (Html2PdfException $e) {
            if (isset($html2pdf)) {
                $html2pdf->clean();
            }

            $formatter = new ExceptionFormatter($e);
            return new Response($formatter->getHtmlMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 

    #[Route('/position_update', name: 'app_position_update', methods: ['POST'])]
    public function positionUpdate(LivresRepository $livreRepository, EntityManagerInterface $entityManager, LoggerInterface $logger): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid data'], 400);
        }

        foreach ($data as $item) {
            $livres = $livreRepository->find($item['id']);
            $livre->setPosition($item['Position']);
            $entityManager->persist($livre);
        }
        $entityManager->flush();
        
        return new JsonResponse(['success' => true]);
    }

    
}