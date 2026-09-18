<?php

declare(strict_types=1);

namespace Course\Ch10;

final class ByTitle implements Ordering
{
    public function apply(array $tracks): array
    {
        usort($tracks, static fn (Track $a, Track $b): int => $a->title <=> $b->title);

        return $tracks;
    }

    public function name(): string
    {
        return 'по названию';
    }
}
