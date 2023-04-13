<?php

declare(strict_types=1);

namespace App\Controller\App;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class IndexController extends AbstractAppController
{
    #[Route('/{route}', name: 'app_playa_index', requirements: ['route' => '.+'], defaults: ['route' => ''], methods: ['GET'], priority: 1)]
    public function index(string $route): Response
    {
        $accessToken = $this->spotifyAuth->getAccessToken();
        $tokenExpiration = $this->spotifyAuth->getTokenExpiration();
        if($accessToken === null || (new DateTime())->getTimestamp() > $tokenExpiration) {
            return $this->redirectToRoute('app_spotify_auth_redirect');
        }
        return $this->render(
            'app/templates/playa/index.html.twig',
            [
                'token' => $this->spotifyAuth->getAccessToken(),
                'tokenDuration' => $this->spotifyAuth->getTokenDuration(),
                'spotifyEndpoints' => $this->getEndpoints(),
                'route' => $route
            ]
        );
    }
}
