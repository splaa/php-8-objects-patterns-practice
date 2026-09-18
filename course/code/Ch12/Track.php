<?php

declare(strict_types=1);

namespace Course\Ch12;

/** Сущность: знает про себя, ничего не знает про хранилище. */
final class Track
{
    public function __construct(
        public ?int $id,
        public readonly int $albumId,
        private string $title,
        private int $seconds,
    ) {
    }

    public function title(): string
    {
        return $this->title;
    }

    public function seconds(): int
    {
        return $this->seconds;
    }

    public function rename(string $title): void
    {
        $this->title = $title;
    }

    /** @return array{album_id: int, title: string, seconds: int} */
    public function toRow(): array
    {
        return ['album_id' => $this->albumId, 'title' => $this->title, 'seconds' => $this->seconds];
    }
}
