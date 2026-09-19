<?php

declare(strict_types=1);

namespace Course\Ch11;

/** Единственное место, где путь превращается в объект действия. */
final class CommandResolver
{
    public function resolve(Request $request): AppCommand
    {
        return match ($request->path) {
            '/playlist' => new ShowPlaylist(),
            '/playlist/add' => new AddTrack(),
            default => new NotFound(),
        };
    }
}
