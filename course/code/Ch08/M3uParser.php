<?php

declare(strict_types=1);

namespace Course\Ch08;

final class M3uParser implements Parser
{
    public function parse(string $raw): array
    {
        $tracks = [];

        foreach (explode(PHP_EOL, trim($raw)) as $line) {
            if (!str_starts_with($line, '#EXTINF:')) {
                continue;
            }

            [$seconds, $title] = explode(',', substr($line, strlen('#EXTINF:')), 2);
            $tracks[] = new Track($title, (int) $seconds);
        }

        return $tracks;
    }
}
