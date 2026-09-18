<?php

declare(strict_types=1);

namespace Course\Ch10;

final class AddTrack implements Command
{
    public function __construct(
        private readonly Playlist $playlist,
        private readonly Track $track,
    ) {
    }

    public function execute(): string
    {
        $this->playlist->add($this->track);

        return "добавил «{$this->track->title}»";
    }

    public function undo(): string
    {
        $this->playlist->remove($this->track);

        return "убрал «{$this->track->title}»";
    }
}
