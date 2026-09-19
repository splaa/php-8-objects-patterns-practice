<?php

declare(strict_types=1);

namespace Course\Ch11;

final class PlaylistRepository
{
    /** @var array<string, list<string>> */
    private array $playlists = ['morning' => ['Coastline', 'Drift']];

    /** @return list<string> */
    public function tracks(string $slug): array
    {
        return $this->playlists[$slug] ?? [];
    }

    public function addTrack(string $slug, string $title): void
    {
        $this->playlists[$slug][] = $title;
    }
}
