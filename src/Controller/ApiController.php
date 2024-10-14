<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface; // Importez EntityManagerInterface

class ApiController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/api/calendrier', name: 'app_calendrier')]
    public function index(CalendarRepository $calendar)
    {
        $events = $calendar->findAll();
        $reservs = [];

        foreach ($events as $event) {
            $reservs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->isAllDay(),
            ];
        }
        $data = json_encode($reservs);

        return $this->render('calendrier/index.html.twig', [
            'data' => $data,
        ]);
    }

   
    #[Route('/api/{id}/edit', name: 'api_event_edit', methods: ['PUT'])]
    public function majEvent(?Calendar $calendar, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());

        if (
            isset($data->title) && !empty($data->title) &&
            isset($data->start) && !empty($data->start) &&
            isset($data->description) && !empty($data->description) &&
            isset($data->background_color) && !empty($data->background_color) &&
            isset($data->text_color) && !empty($data->text_color)
        ) {
            // Détermine le code de statut en fonction de si un événement existe déjà ou non
            $code = $calendar ? 200 : 201;

            // Si aucun événement n'existe, créez un nouveau
            $calendar = $calendar ?? new Calendar;

            // Met à jour les propriétés de l'événement avec les données du payload
            $calendar->setTitle($data->title);
            $calendar->setStart(new \DateTime($data->start));
            $calendar->setEnd($data->all_day ? new \DateTime($data->start) : new \DateTime($data->end));
            $calendar->setDescription($data->description);
            $calendar->setAllDay($data->all_day);
            $calendar->setBackgroundColor($data->background_color);
            $calendar->setTextColor($data->text_color);

            // Persiste les changements en base de données
            $em = $this->entityManager; // Utilisez $this->entityManager
            $em->persist($calendar);
            $em->flush();

            // Retourne une réponse JSON avec le code de statut approprié
            return new JsonResponse(['message' => 'Événement enregistré avec succès'], $code);
        } else {
            // Si des données obligatoires sont manquantes, retourne une réponse avec un code d'erreur approprié
            return new JsonResponse(['error' => 'Tous les champs sont obligatoires'], 400);
        }
    }
}
