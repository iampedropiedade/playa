<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/spotify/context', priority: 10)]
class ContextController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_context', methods: ['GET'])]
    public function index(string $contextId): JsonResponse
    {
        return new JsonResponse([]);
    }

    #[Route('/{contextId}', name: 'api_spotify_context_show', methods: ['GET'])]
    public function show(string $contextId): JsonResponse
    {
        $context = explode(':', $contextId);
        return new JsonResponse($this->spotify->getPlaylist($context[2]));
    }

}
