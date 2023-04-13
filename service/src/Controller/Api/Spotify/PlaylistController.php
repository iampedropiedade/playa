<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use SpotifyWebAPI\SpotifyWebAPIException;

#[Route('/api/spotify/playlists', priority: 10)]
class PlaylistController extends AbstractSpotifyController
{
    #[Route('', name: 'api_spotify_playlists', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->getMyPlaylists();
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }

    #[Route('/{id}', name: 'api_spotify_playlist_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->getPlaylist($id);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }

    #[Route('/{id}', name: 'api_spotify_playlist_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->unfollowPlaylist($id);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }

    #[Route('/{id}/{trackId}', name: 'api_spotify_playlist_add_track', methods: ['POST'])]
    public function addTrack(string $id, string $trackId): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->addPlaylistTracks($id, [$trackId]);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }

    #[Route('/{id}/{trackId}', name: 'api_spotify_playlist_delete_track', methods: ['DELETE'])]
    public function removeTrack(string $id, string $trackId): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        try {
            $result = $this->spotify->deletePlaylistTracks($id, ['tracks' => [['uri' =>$trackId]]]);
        }
        catch(SpotifyWebAPIException $e) {
            $result = $e->getMessage();
        }
        return new JsonResponse($result);
    }

}
