<?php

declare(strict_types=1);

namespace Course\Ch03;

/** Альбом не наследует трек — он им владеет. Это композиция. */
final class Album
{
    /** @var list<Track> */
    private array $tracks = [];

    public function __construct(public readonly string $title)
    {
    }

    public function add(Track $track): void
    {
        $this->tracks[] = $track;
    }

    public function playAll(): string
    {
        $lines = array_map(static fn (Track $track): string => '  ' . $track->play(), $this->tracks);

        return $this->title . PHP_EOL . implode(PHP_EOL, $lines);
    }
}
