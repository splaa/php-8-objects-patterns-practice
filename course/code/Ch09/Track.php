<?php

declare(strict_types=1);

namespace Course\Ch09;

final class Track implements PlaylistNode
{
    public function __construct(
        private readonly string $title,
        private readonly int $seconds,
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

    public function render(int $depth = 0): string
    {
        return str_repeat('  ', $depth) . "- {$this->title} ({$this->seconds} сек)";
    }
}
