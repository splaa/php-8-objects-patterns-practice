<?php

declare(strict_types=1);

namespace Course\Ch08;

use ArrayObject;

/** Prototype: дорогую заготовку собираем один раз и клонируем. */
final class PlaylistTemplate
{
    /** @param ArrayObject<int, Track> $tracks */
    public function __construct(
        public string $title,
        private ArrayObject $tracks,
    ) {
    }

    /** @param list<Track> $tracks */
    public static function of(string $title, array $tracks): self
    {
        return new self($title, new ArrayObject($tracks));
    }

    public function add(Track $track): void
    {
        $this->tracks->append($track);
    }

    public function count(): int
    {
        return $this->tracks->count();
    }

    /** Без этого клон делил бы один ArrayObject с оригиналом. */
    public function __clone(): void
    {
        $this->tracks = clone $this->tracks;
    }
}
