<?php

declare(strict_types=1);

namespace App\Model\Api\Spotify;
use DateTime;

class AccessToken
{
    protected string $accessToken;
    protected int $tokenExpiration;
    protected int $tokenDuration;

    public function __construct(string $accessToken, int $tokenExpiration)
    {
        $this->accessToken = $accessToken;
        $this->tokenExpiration = $tokenExpiration;
        $this->setTokenDuration();
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function getTokenExpiration(): int
    {
        return $this->tokenExpiration;
    }

    public function setTokenExpiration(int $tokenExpiration): void
    {
        $this->tokenExpiration = $tokenExpiration;
    }

    public function getTokenDuration(): int
    {
        return $this->tokenDuration;
    }

    public function setTokenDuration(): void
    {
        $this->tokenDuration = $this->tokenExpiration - (new DateTime())->getTimestamp();
    }

}
