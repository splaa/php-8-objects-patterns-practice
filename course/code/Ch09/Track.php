<?php

declare(strict_types=1);

namespace Course\Ch09;

final class Track implements PlaylistNode
{
    public function __construct(
        public readonly string $title,
        public readonly int $seconds,
    ) {
    }

    public function render(int $depth = 0): string
    {
        return str_repeat('  ', $depth) . "- {$this->title} ({$this->seconds} сек)";
    }
}
