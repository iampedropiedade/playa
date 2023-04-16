<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use SpotifyWebAPI\SpotifyWebAPIException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/spotify/player', priority: 10)]
class PlayerController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_player', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->spotify->getMyCurrentPlaybackInfo());
    }

    #[Route('/play/{deviceId}', name: 'api_spotify_player_play', methods: ['PUT'])]
    public function play(string $deviceId, Request $request): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $options = json_decode($request->getContent(), true);
            $result = $this->spotify->play($deviceId, $options);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }

}
