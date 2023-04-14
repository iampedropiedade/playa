<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use SpotifyWebAPI\SpotifyWebAPIException;

#[Route('/api/spotify/recommendations', priority: 10)]
class RecommendationsController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_recommendations', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([]);
    }

    #[Route('/track/{id}', name: 'api_spotify_recommendations_track', methods: ['GET'])]
    public function track(string $id): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->getRecommendations(['seed_tracks'=>[$id]]);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }
}
