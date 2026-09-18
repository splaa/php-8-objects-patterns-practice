<?php

declare(strict_types=1);

namespace Course\Ch08;

final class CsvParser implements Parser
{
    public function parse(string $raw): array
    {
        $tracks = [];

        foreach (explode(PHP_EOL, trim($raw)) as $line) {
            [$title, $seconds] = explode(';', $line);
            $tracks[] = new Track($title, (int) $seconds);
        }

        return $tracks;
    }
}
