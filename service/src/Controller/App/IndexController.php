<?php

declare(strict_types=1);

namespace App\Controller\App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class IndexController extends AbstractAppController
{
    protected const FLASH_ROUTE_REQUEST = 'route_request';

    #[Route('/{route}', name: 'app_playa_index', requirements: ['route' => '.+'], defaults: ['route' => ''], methods: ['GET'], priority: 1)]
    public function index(string $route, Request $request): Response
    {
        $accessToken = $this->spotifyAuth->getAccessToken();
        $tokenExpiration = $this->spotifyAuth->getTokenExpiration();
        if($accessToken === null || (new DateTime())->getTimestamp() > $tokenExpiration) {
            $this->addFlash(self::FLASH_ROUTE_REQUEST, $route);
            return $this->redirectToRoute('app_spotify_auth_redirect');
        }
        if($route === '') {
            $routeFlash = $request->getSession()->getFlashBag()->get(self::FLASH_ROUTE_REQUEST);
            $route = $routeFlash[0] ?? '';
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
