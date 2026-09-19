<?php

declare(strict_types=1);

namespace Course\Ch07;

final class M3uFormatter implements Formatter
{
    public function format(array $tracks): string
    {
        $lines = ['#EXTM3U'];

        foreach ($tracks as $track) {
            $lines[] = "#EXTINF:{$track->seconds},{$track->title}";
        }

        return implode(' / ', $lines);
    }
}
