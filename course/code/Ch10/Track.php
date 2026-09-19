<?php

declare(strict_types=1);

namespace Course\Ch10;

final class Track implements PlaylistNode
{
    public function __construct(
        public readonly string $title,
        public readonly int $seconds,
    ) {
    }

    public function accept(NodeVisitor $visitor): void
    {
        $visitor->visitTrack($this);
    }
}
