<?php

declare(strict_types=1);

namespace Course\Ch04;

final class Player
{
    /** @param list<Playable> $queue */
    public function __construct(private readonly array $queue)
    {
    }

    public function run(): string
    {
        $lines = [];
        $total = 0;

        foreach ($this->queue as $item) {
            $total += $item->seconds();
            $lines[] = sprintf('%s (%s)', $item->label(), $item->duration());
        }

        $lines[] = sprintf('Всего: %d сек', $total);

        return implode(PHP_EOL, $lines);
    }
}
