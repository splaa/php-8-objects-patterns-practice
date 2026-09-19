<?php

declare(strict_types=1);

namespace Course\Ch08;

/** Factory Method: алгоритм здесь, выбор конкретного парсера — в наследнике. */
abstract class Importer
{
    abstract protected function createParser(): Parser;

    /** @return list<Track> */
    final public function import(string $raw): array
    {
        $tracks = $this->createParser()->parse($raw);

        usort($tracks, static fn (Track $a, Track $b): int => $a->title <=> $b->title);

        return $tracks;
    }
}
