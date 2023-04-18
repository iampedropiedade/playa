<?php

declare(strict_types=1);

namespace App\Client\SpotifyDownloader;

use App\Client\SpotifyDownloader\Model\Download as Model;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Download extends Client
{
    protected const ENDPOINT = '/download/%s';

    public function download(string $id): ?Model
    {
        $this->addToEndpoint(sprintf(self::ENDPOINT, $id));
        try {
            $response = $this->get();
        } catch (TransportExceptionInterface|ServerException) {
            return null;
        }

        /** @var Model $model */
        $model = $this->serializer->deserialize(
            $response->getContent(),
            Model::class,
            'json',
        );
        return $model;
    }
}
