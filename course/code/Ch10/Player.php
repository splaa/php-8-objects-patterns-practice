<?php

declare(strict_types=1);

namespace Course\Ch10;

final class Player
{
    /** @var list<PlayerListener> */
    private array $listeners = [];

    public function __construct(private readonly Ordering $ordering)
    {
    }

    public function subscribe(PlayerListener $listener): void
    {
        $this->listeners[] = $listener;
    }

    /** @param list<Track> $tracks */
    public function play(array $tracks): void
    {
        foreach ($this->ordering->apply($tracks) as $track) {
            foreach ($this->listeners as $listener) {
                $listener->trackStarted($track);
            }
        }
    }
}
