<?php

declare(strict_types=1);

namespace Course\Ch05;

final class Track
{
    public function __construct(
        public readonly int|string $id,
        public readonly string $title,
        public readonly int $seconds,
        public readonly Quality $quality = Quality::Standard,
        public readonly ?string $lyrics = null,
    ) {
    }

    /** Неизменяемость не мешает «менять»: возвращаем копию. */
    public function withQuality(Quality $quality): self
    {
        return new self($this->id, $this->title, $this->seconds, $quality, $this->lyrics);
    }

    public function sizeMb(): float
    {
        return round($this->quality->bitrate() * $this->seconds / 8 / 1024, 1);
    }

    public function lyricsPreview(): string
    {
        return $this->lyrics === null
            ? 'текста нет'
            : substr($this->lyrics, 0, 20) . '...';
    }
}
