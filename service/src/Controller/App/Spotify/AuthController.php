<?php

declare(strict_types=1);

namespace App\Controller\App\Spotify;

use App\Exceptions\SpotifyException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/spotify/auth', priority: 10)]
class AuthController extends AbstractSpotifyController
{
    #[Route('', name: 'app_spotify_auth_redirect', methods: ['GET'])]
    public function authRedirect(): Response
    {
        $callbackUrl = $this->generateUrl('app_spotify_auth_callback', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $redirectUrl = $this->spotifyAuth->getRedirectUrl($callbackUrl);
        return $this->redirect($redirectUrl);
    }

    #[Route('/callback', name: 'app_spotify_auth_callback', methods: ['GET'])]
    public function authCallback(): Response
    {
        try {
            $this->spotifyAuth->auth();
        }
        catch (SpotifyException $e) {
            $this->redirectToRoute('app_index');
        }
        return $this->redirectToRoute('app_playa_index');
    }
}
