<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class TranslateController extends AbstractController
{
    #[Route('/switch-language/{_locale}', name: 'app_switch_language')]
    public function switchLanguage(Request $request, string $_locale, TranslatorInterface $translator): Response
    {
        // Configurer la langue sélectionnée comme la locale actuelle
        $request->getSession()->set('_locale', $_locale);

        // Rediriger vers la page précédente ou une page spécifique
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);

        // logique de traduction 
        // $translatedMessage = $translator->trans('app.translate.message');

        // lien pour mes boutons de translation de la langue
        // <a href="{{ path('app_switch_language', {'_locale': 'en'}) }}">English</a>
        // <a href="{{ path('app_switch_language', {'_locale': 'fr'}) }}">French</a>

    }
}
