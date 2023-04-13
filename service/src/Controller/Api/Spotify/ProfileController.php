<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/spotify/profile', priority: 10)]
class ProfileController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_profile', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->spotify->me());
    }

}
