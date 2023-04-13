<?php

declare(strict_types=1);

namespace App\Service\Spotify;

use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
abstract class Spotify
{
    protected SessionInterface $session;
    protected Request $request;

    public function __construct(
        protected RequestStack $requestStack,
        protected readonly SpotifyWebAPI $api,
        protected readonly Session $spotifySession
    )
    {
        $this->request = $this->requestStack->getCurrentRequest();
        $this->session = $this->request->getSession();
    }

    protected function getAuthOptions(): array
    {
        return [
            'scope' => [
                'ugc-image-upload',
                'user-read-email',
                'user-read-private',
                'user-read-playback-state',
                'user-modify-playback-state',
                'user-read-currently-playing',
                'app-remote-control',
                'streaming',
                'playlist-read-private',
                'playlist-read-collaborative',
                'playlist-modify-private',
                'playlist-modify-public',
                'user-read-playback-position',
                'user-top-read',
                'user-read-recently-played',
                'user-library-modify',
                'user-library-read',
            ],
            'state' => $this->spotifySession->generateState(),
        ];
    }

}