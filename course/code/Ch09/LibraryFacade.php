<?php

declare(strict_types=1);

namespace Course\Ch09;

/**
 * Фасад: одна понятная операция вместо трёх подсистем.
 * Внутри он ничего не делает сам — только собирает и вызывает.
 */
final class LibraryFacade
{
    /** @param array<string, array<string, int>> $spec альбом => [название трека => секунды] */
    public function eveningMix(array $spec): string
    {
        $root = new Playlist('Вечерний микс');

        foreach ($spec as $albumTitle => $tracks) {
            $album = new Playlist($albumTitle);

            foreach ($tracks as $title => $seconds) {
                $album->add(new Track($title, $seconds));
            }

            $root->add($album);
        }

        $playback = new Normalized(new FadeIn(new RawPlayback($root), 3));

        return $root->render() . PHP_EOL . $playback->play();
    }
}
