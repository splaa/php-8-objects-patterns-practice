<?php

declare(strict_types=1);

namespace Course\Ch09;

/** Общий тип для листа (трек) и ветки (плейлист). */
interface PlaylistNode
{
    public function title(): string;

    public function seconds(): int;

    public function render(int $depth = 0): string;
}
