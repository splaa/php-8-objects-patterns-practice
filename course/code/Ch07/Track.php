<?php

declare(strict_types=1);

namespace Course\Ch07;

final class Track
{
    public function __construct(
        public readonly string $title,
        public readonly int $seconds,
    ) {
    }
}
