<?php

declare(strict_types=1);

namespace Course\Ch11;

final class AddTrack implements AppCommand
{
    public function run(Request $request, Registry $registry): string
    {
        $slug = $request->param('slug', 'morning');
        $title = $request->param('title');

        if ($title === '') {
            return 'Не передано название трека';
        }

        $registry->get(PlaylistRepository::class)->addTrack($slug, $title);

        return "В плейлист {$slug} добавлен «{$title}»";
    }
}
