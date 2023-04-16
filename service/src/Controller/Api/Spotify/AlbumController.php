<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use SpotifyWebAPI\SpotifyWebAPIException;

#[Route('/api/spotify/albums', priority: 10)]
class AlbumController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_albums', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([]);
    }

    #[Route('/{id}', name: 'api_spotify_album_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->getAlbum($id);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }
}
