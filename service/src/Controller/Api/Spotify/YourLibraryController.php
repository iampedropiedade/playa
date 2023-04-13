<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use SpotifyWebAPI\SpotifyWebAPIException;

#[Route('/api/spotify/your-library', priority: 10)]
class YourLibraryController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_your_library', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->getMySavedTracks();
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }

    #[Route('/{id}', name: 'api_spotify_your_library_like', methods: ['POST'])]
    public function like(string $id): JsonResponse
    {
        return new JsonResponse($this->spotify->addMyTracks([$id]));
    }

}
