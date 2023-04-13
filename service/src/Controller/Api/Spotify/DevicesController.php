<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/spotify/devices', priority: 10)]
class DevicesController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_devices', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->spotify->getMyDevices());
    }

    #[Route('/{id}', name: 'api_spotify_devices_set', methods: ['POST'])]
    public function set(Request $request): JsonResponse
    {
        return new JsonResponse($this->spotify->changeMyDevice(['device_ids'=>$request->get('id'), 'play'=>true]));
    }
}
