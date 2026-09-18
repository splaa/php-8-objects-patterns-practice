<?php

declare(strict_types=1);

namespace Course\Ch04;

/** Реализует интерфейс напрямую: общий предок не нужен. */
final class Jingle implements Playable
{
    use FormatsDuration;

    public function __construct(private readonly string $sponsor)
    {
    }

    public function seconds(): int
    {
        return 5;
    }

    public function label(): string
    {
        return "Реклама: {$this->sponsor}";
    }
}
