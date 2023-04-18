<?php

declare(strict_types=1);

namespace App\Client\SpotifyDownloader\Model;

class Download
{
    protected bool $success;
    protected Metadata $metadata;
    protected string $link;
    protected ?int $expiresAt = null;

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    public function setMetadata(Metadata $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getExpiresAt(): ?int
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(int $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

}
