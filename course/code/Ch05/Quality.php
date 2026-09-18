<?php

declare(strict_types=1);

namespace Course\Ch05;

enum Quality: string
{
    case Low = 'low';
    case Standard = 'standard';
    case Lossless = 'lossless';

    public function bitrate(): int
    {
        return match ($this) {
            self::Low => 96,
            self::Standard => 256,
            self::Lossless => 1411,
        };
    }
}
