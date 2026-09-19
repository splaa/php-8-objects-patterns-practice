<?php

declare(strict_types=1);

namespace Course\Ch09;

final class RawPlayback implements Playback
{
    public function __construct(private readonly PlaylistNode $node)
    {
    }

    public function play(): string
    {
        return "звук: {$this->node->title}";
    }
}
