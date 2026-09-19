<?php

declare(strict_types=1);

namespace Course\Ch12;

/** Identity Map: одна строка базы — ровно один объект в памяти. */
final class IdentityMap
{
    /** @var array<int, Track> */
    private array $tracks = [];

    public function get(int $id): ?Track
    {
        return $this->tracks[$id] ?? null;
    }

    public function put(Track $track): void
    {
        if ($track->id !== null) {
            $this->tracks[$track->id] = $track;
        }
    }
}
