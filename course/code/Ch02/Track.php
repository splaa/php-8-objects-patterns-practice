<?php

declare(strict_types=1);

namespace Course\Ch02;

use InvalidArgumentException;

final class Track
{
    public const MAX_SECONDS = 3 * 3600;

    private static int $created = 0;

    private int $plays = 0;

    public function __construct(
        public readonly string $title,
        public readonly string $artist,
        private readonly int $seconds,
    ) {
        if ($seconds <= 0 || $seconds > self::MAX_SECONDS) {
            throw new InvalidArgumentException("Недопустимая длительность: {$seconds}");
        }

        self::$created++;
    }

    public static function fromMinutes(string $title, string $artist, float $minutes): self
    {
        return new self($title, $artist, (int) round($minutes * 60));
    }

    public static function createdCount(): int
    {
        return self::$created;
    }

    public function seconds(): int
    {
        return $this->seconds;
    }

    public function plays(): int
    {
        return $this->plays;
    }

    public function play(): void
    {
        $this->plays++;
    }

    public function duration(): string
    {
        return sprintf('%d:%02d', intdiv($this->seconds, 60), $this->seconds % 60);
    }

    public function __toString(): string
    {
        return "{$this->artist} — {$this->title} ({$this->duration()})";
    }
}
