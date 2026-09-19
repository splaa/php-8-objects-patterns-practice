<?php

declare(strict_types=1);

namespace Course\Ch08;

final class CsvWriter implements Writer
{
    public function write(array $tracks): string
    {
        return implode(PHP_EOL, array_map(static fn (Track $t): string => "{$t->title};{$t->seconds}", $tracks));
    }
}
