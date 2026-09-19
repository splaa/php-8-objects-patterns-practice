<?php

declare(strict_types=1);

namespace Course\Ch12;

/** Обычный класс без единой строки про ленивость: её добавит AlbumMapper. */
final class Album
{
    /** @param list<Track> $tracks */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly array $tracks,
    ) {
    }

    public function seconds(): int
    {
        return array_sum(array_map(static fn (Track $t): int => $t->seconds, $this->tracks));
    }
}
