<?php

declare(strict_types=1);

namespace Course\Ch09;

final class Normalized extends PlaybackDecorator
{
    public function play(): string
    {
        return $this->inner->play() . ' -> громкость -14 LUFS';
    }
}
