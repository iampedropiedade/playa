<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use App\Client\SpotifyDownloader\Download;
use App\Response\DynamicBinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use SpotifyWebAPI\SpotifyWebAPIException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    #[Route('/{id}/download', name: 'api_spotify_track_download', methods: ['GET'])]
    public function download(string $id, Download $downloadClient): JsonResponse
    {
        $this->spotifyAuth->checkAuth();
        $download = $downloadClient->download($id);
        return JsonResponse::fromJsonString($this->serializer->serialize($download, 'json'));
    }

    #[Route('/{id}/force-download', name: 'api_spotify_track_force_download', methods: ['GET'])]
    public function forceDownload(string $id, Download $downloadClient): Response
    {
        $this->spotifyAuth->checkAuth();

        try {
            $download = $downloadClient->download($id);
        }
        catch(ServerException $e) {
            return new JsonResponse('There was an error while accessing the API: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if($download->getExpiresAt() === null) {
            return new JsonResponse('There was an error while converting this file.', Response::HTTP_BAD_REQUEST);
        }
        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', 'audio/mpeg');
        $response->headers->set('Content-Disposition', 'attachment; filename="file.mp3";');
        $response->sendHeaders();
        $response->setContent(file_get_contents($download->getLink()));
        return $response;

        return new StreamedResponse(static function () use ($download): void {
            file_get_contents($download->getLink());
        }, Response::HTTP_OK, [
            'Content-Transfer-Encoding', 'binary',
            'Content-Type' => 'audio/mpeg',
            'Content-Disposition' => 'attachment; filename="track.mp3"',
        ]);
    }

}
