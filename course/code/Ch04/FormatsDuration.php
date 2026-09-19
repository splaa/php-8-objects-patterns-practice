<?php

declare(strict_types=1);

namespace Course\Ch04;

/** Трейт добавляет реализацию, а не тип: типом остаётся Playable. */
trait FormatsDuration
{
    public string $duration {
        get => match (true) {
            $this->seconds >= 3600 => sprintf(
                '%d:%02d:%02d',
                intdiv($this->seconds, 3600),
                intdiv($this->seconds % 3600, 60),
                $this->seconds % 60,
            ),
            default => sprintf('%d:%02d', intdiv($this->seconds, 60), $this->seconds % 60),
        };
    }
}
