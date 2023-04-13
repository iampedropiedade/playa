<?php

declare(strict_types=1);

namespace App\Controller\Api\Spotify;

use App\Controller\Api\AbstractApiController;
use App\Service\Spotify\Auth;
use SpotifyWebAPI\SpotifyWebAPI;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractSpotifyController extends AbstractApiController
{
    public function __construct(
        protected readonly SpotifyWebAPI $spotify,
        protected readonly Auth $spotifyAuth,
        SerializerInterface $serializer
    )
    {
        parent::__construct($serializer);
        $this->spotify->setAccessToken($spotifyAuth->getAccessToken());
    }
}
