<?php

declare(strict_types=1);

namespace App\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DynamicBinaryFileResponse extends Response
{
    /**
     * @param array<string, string> $headers
     */
    public function __construct(
        ?string $content = '',
        int $status = 200,
        string $filename = 'file',
        string $mimeType = 'audio/mpeg',
        array $headers = []
    ) {
        parent::__construct($content, $status, $headers);
        $this->headers->set('Content-Type', $mimeType);
        $this->setFilename($filename);
    }

    public function setFilename(string $filename): self
    {
        $disposition = $this->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );
        $this->headers->set('Content-Disposition', $disposition);
        return $this;
    }
}
