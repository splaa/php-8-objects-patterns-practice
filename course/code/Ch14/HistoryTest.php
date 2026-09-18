<?php

declare(strict_types=1);

namespace Course\Ch14;

use Course\Ch10\AddTrack;
use Course\Ch10\History;
use Course\Ch10\Playlist;
use Course\Ch10\RenamePlaylist;
use Course\Ch10\Track;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class HistoryTest extends TestCase
{
    public function testUndoRestoresPreviousTitle(): void
    {
        $playlist = new Playlist('Утро');
        $history = new History();

        $history->run(new RenamePlaylist($playlist, 'Вечер'));
        self::assertSame('Вечер', $playlist->title());

        $history->undoLast();
        self::assertSame('Утро', $playlist->title());
    }

    public function testUndoRemovesOnlyLastCommand(): void
    {
        $playlist = new Playlist('Утро');
        $history = new History();

        $history->run(new AddTrack($playlist, new Track('Coastline', 215)));
        $history->run(new RenamePlaylist($playlist, 'Вечер'));
        $history->undoLast();

        self::assertSame('Утро', $playlist->title());
        self::assertCount(1, $playlist->tracks());
    }

    public function testEmptyHistoryComplains(): void
    {
        $this->expectException(RuntimeException::class);

        (new History())->undoLast();
    }
}
