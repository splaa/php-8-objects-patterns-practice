<?php

declare(strict_types=1);

namespace Course\Ch12;

/** Unit of Work: копим изменения и записываем их одним заходом. */
final class UnitOfWork
{
    /** @var list<Track> */
    private array $new = [];

    /** @var array<int, Track> */
    private array $dirty = [];

    public function __construct(private readonly TrackMapper $mapper)
    {
    }

    public function registerNew(Track $track): void
    {
        $this->new[] = $track;
    }

    public function registerDirty(Track $track): void
    {
        if ($track->id !== null) {
            // Ключ по идентификатору: два изменения одного трека дадут один UPDATE.
            $this->dirty[$track->id] = $track;
        }
    }

    public function commit(): int
    {
        $written = 0;

        foreach ($this->new as $track) {
            $this->mapper->insert($track);
            $written++;
        }

        foreach ($this->dirty as $track) {
            $this->mapper->update($track);
            $written++;
        }

        $this->new = [];
        $this->dirty = [];

        return $written;
    }
}
