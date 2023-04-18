<?php

declare(strict_types=1);

namespace App\Client\SpotifyDownloader;

use App\Client\AbstractClient\AbstractClient;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client extends AbstractClient
{
    public function __construct(
        HttpClientInterface $spotifyDownloader,
        SerializerInterface $serializer,
        LoggerInterface $logger
    ) {
        $this->client = $spotifyDownloader;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }
}
