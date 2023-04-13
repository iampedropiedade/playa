<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use App\Model\Api\Spotify\AccessToken;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/spotify/auth', priority: 10)]
class AuthController extends AbstractSpotifyController
{

    #[Route('/refresh-token', name: 'api_spotify_auth_refresh_token', methods: ['GET'])]
    public function authRefresh(): Response
    {
        $this->spotifyAuth->refreshAccessToken();
        return JsonResponse::fromJsonString(
            $this->serializer->serialize(
                new AccessToken($this->spotifyAuth->getAccessToken(), $this->spotifyAuth->getTokenExpiration()),
                'json'
            )
        );
    }
}
