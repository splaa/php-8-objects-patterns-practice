<?php

declare(strict_types=1);

namespace Course\Ch04;

final class Track extends MediaItem
{
    public function __construct(string $title, int $seconds, private readonly string $artist)
    {
        parent::__construct($title, $seconds);
    }

    public function label(): string
    {
        return "{$this->artist} — {$this->title}";
    }
}
