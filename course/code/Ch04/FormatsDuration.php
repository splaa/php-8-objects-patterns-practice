<?php

declare(strict_types=1);

namespace Course\Ch04;

/** Трейт добавляет реализацию, а не тип: типом остаётся Playable. */
trait FormatsDuration
{
    public function duration(): string
    {
        $seconds = $this->seconds();

        return match (true) {
            $seconds >= 3600 => sprintf('%d:%02d:%02d', intdiv($seconds, 3600), intdiv($seconds % 3600, 60), $seconds % 60),
            default => sprintf('%d:%02d', intdiv($seconds, 60), $seconds % 60),
        };
    }

    abstract public function seconds(): int;
}
