<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use SpotifyWebAPI\SpotifyWebAPIException;

#[Route('/api/spotify/queue', priority: 10)]
class QueueController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_queue', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([]);
    }

    #[Route('/track/{id}', name: 'api_spotify_queue_add_track', methods: ['POST'])]
    public function add(string $id): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->queue($id);
            if($result) {
                $result = $this->spotify->next();
            }
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }
}
