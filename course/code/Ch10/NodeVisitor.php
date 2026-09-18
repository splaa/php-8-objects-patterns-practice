<?php

declare(strict_types=1);

namespace Course\Ch10;

/** Visitor: новая операция над деревом без правки классов дерева. */
interface NodeVisitor
{
    public function visitTrack(Track $track): void;

    public function visitPlaylist(Playlist $playlist): void;
}
