<?php

declare(strict_types=1);

namespace Course\Ch11;

final class ShowPlaylist implements AppCommand
{
    public function run(Request $request, Registry $registry): string
    {
        $slug = $request->param('slug', 'morning');
        $tracks = $registry->get(PlaylistRepository::class)->tracks($slug);

        return match ($tracks) {
            [] => "Плейлист {$slug} пуст или не существует",
            default => "Плейлист {$slug}: " . implode(', ', $tracks),
        };
    }
}
