<?php

declare(strict_types=1);

namespace Course\Ch10;

final class LongestFirst implements Ordering
{
    public function apply(array $tracks): array
    {
        usort($tracks, static fn (Track $a, Track $b): int => $b->seconds <=> $a->seconds);

        return $tracks;
    }

    public function name(): string
    {
        return 'сначала длинные';
    }
}
