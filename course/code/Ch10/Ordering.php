<?php

declare(strict_types=1);

namespace Course\Ch10;

/** Strategy: подменяемый алгоритм с общим интерфейсом. */
interface Ordering
{
    /**
     * @param list<Track> $tracks
     * @return list<Track>
     */
    public function apply(array $tracks): array;

    public function name(): string;
}
