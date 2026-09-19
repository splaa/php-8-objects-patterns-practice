<?php

declare(strict_types=1);

namespace Course\Ch09;

/** Общий тип для листа (трек) и ветки (плейлист). */
interface PlaylistNode
{
    public string $title { get; }

    public int $seconds { get; }

    public function render(int $depth = 0): string;
}
