<?php

declare(strict_types=1);

namespace Course\Ch08;

final class M3uWriter implements Writer
{
    public function write(array $tracks): string
    {
        $lines = ['#EXTM3U'];

        foreach ($tracks as $track) {
            $lines[] = "#EXTINF:{$track->seconds},{$track->title}";
        }

        return implode(PHP_EOL, $lines);
    }
}
