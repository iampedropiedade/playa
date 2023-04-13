<?php

declare(strict_types=1);

namespace App\Service\Spotify;

use App\Exceptions\SpotifyException;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use DateTime;

class Auth extends Spotify
{
    protected const ACCESS_TOKEN = 'spotify_access_token';
    protected const REFRESH_TOKEN = 'spotify_refresh_token';
    protected const TOKEN_EXPIRATION = 'spotify_token_expiration';

    /**
     * @throws SpotifyException
     */
    public function auth()
    {
        try {
            $this->spotifySession->requestAccessToken($this->request->query->get('code'));
        }
        catch (SpotifyWebAPIAuthException $e) {
            throw new SpotifyException($e->getMessage());
        }
        $this->saveAuth();
    }

    public function getRedirectUrl(string $callbackUrl): string
    {
        $this->spotifySession->setRedirectUri($callbackUrl);
        return $this->spotifySession->getAuthorizeUrl($this->getAuthOptions());
    }

    public function checkAuth(): void
    {
        if($this->getTokenExpiration() !== null && $this->getTokenExpiration() > (new DateTime())->getTimestamp()) {
            return;
        }
        $this->refreshAccessToken();
    }

    public function refreshAccessToken(): string
    {
        $this->spotifySession->refreshAccessToken($this->getRefreshToken());
        $this->saveAuth();
        return $this->spotifySession->getAccessToken();
    }

    public function getAccessToken(): ?string
    {
        return $this->session->get(self::ACCESS_TOKEN);
    }

    public function getTokenExpiration(): ?int
    {
        return $this->session->get(self::TOKEN_EXPIRATION);
    }

    public function getTokenDuration(): int
    {
        $tokenExpiration = $this->getTokenExpiration();
        if($tokenExpiration === null) {
            return 0;
        }
        return max($tokenExpiration - (new DateTime())->getTimestamp(), 0);
    }

    protected function getRefreshToken(): ?string
    {
        return $this->session->get(self::REFRESH_TOKEN);
    }

    protected function saveAuth()
    {
        $session = $this->request->getSession();
        $session->set(self::ACCESS_TOKEN, $this->spotifySession->getAccessToken());
        $session->set(self::REFRESH_TOKEN, $this->spotifySession->getRefreshToken());
        $session->set(self::TOKEN_EXPIRATION, $this->spotifySession->getTokenExpiration());
    }
}