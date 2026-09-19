<?php

declare(strict_types=1);

namespace Course\Ch10;

final class StatsVisitor implements NodeVisitor
{
    private int $tracks = 0;

    private int $playlists = 0;

    private int $seconds = 0;

    private ?Track $longest = null;

    public function visitTrack(Track $track): void
    {
        $this->tracks++;
        $this->seconds += $track->seconds;

        if ($this->longest === null || $track->seconds > $this->longest->seconds) {
            $this->longest = $track;
        }
    }

    public function visitPlaylist(Playlist $playlist): void
    {
        $this->playlists++;
    }

    public function report(): string
    {
        return sprintf(
            'плейлистов: %d, треков: %d, всего %d сек, самый длинный — %s',
            $this->playlists,
            $this->tracks,
            $this->seconds,
            $this->longest?->title ?? 'нет',
        );
    }
}
