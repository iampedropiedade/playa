<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use SpotifyWebAPI\SpotifyWebAPIException;

#[Route('/api/spotify/tracks', priority: 10)]
class TrackController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_tracks', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([]);
    }

    #[Route('/{id}', name: 'api_spotify_track_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->getTrack($id);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }
}
