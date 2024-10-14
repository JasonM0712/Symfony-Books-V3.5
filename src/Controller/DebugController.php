<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DebugController extends AbstractController
{
    #[Route('/position_debug', name: 'app_position_debug', methods: ['POST'])]
    public function positionUpdate(): JsonResponse
    { 
        return new JsonResponse(['success' => true]);
    }
}
