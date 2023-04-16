<?php

declare(strict_types=1);

namespace App\Controller\App;

use App\Service\Spotify\Auth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractAppController extends AbstractController
{
    protected array $spotifyEndpoints;

    public function __construct(
        protected readonly Auth $spotifyAuth,
    ) {
    }

    public function getEndpoints(): array
    {
        return [
            'player' => $this->generateUrl('api_spotify_player'),
            'tracks' => $this->generateUrl('api_spotify_tracks'),
            'queue' => $this->generateUrl('api_spotify_queue'),
            'albums' => $this->generateUrl('api_spotify_albums'),
            'playlists' => $this->generateUrl('api_spotify_playlists'),
            'recommendations' => $this->generateUrl('api_spotify_recommendations'),
            'yourLibrary' => $this->generateUrl('api_spotify_your_library'),
            'context' => $this->generateUrl('api_spotify_context'),
            'devices' => $this->generateUrl('api_spotify_devices'),
            'refreshToken' => $this->generateUrl('api_spotify_auth_refresh_token'),
            'profile' => $this->generateUrl('api_spotify_profile'),
        ];
    }
}
