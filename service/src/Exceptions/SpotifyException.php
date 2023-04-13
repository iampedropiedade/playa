<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SpotifyException extends Exception implements Throwable
{
    /** @var string */
    protected $message = 'Spotify exception';

    /** @var int  */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
