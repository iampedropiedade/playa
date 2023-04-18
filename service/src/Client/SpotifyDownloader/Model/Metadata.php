<?php

declare(strict_types=1);

namespace App\Client\SpotifyDownloader\Model;

class Metadata
{
    protected string $id;
    protected string $artists;
    protected string $title;
    protected string $cover;
    protected string $album;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getArtists(): string
    {
        return $this->artists;
    }

    public function setArtists(string $artists): void
    {
        $this->artists = $artists;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCover(): string
    {
        return $this->cover;
    }

    public function setCover(string $cover): void
    {
        $this->cover = $cover;
    }

    public function getAlbum(): string
    {
        return $this->album;
    }

    public function setAlbum(string $album): void
    {
        $this->album = $album;
    }
}
