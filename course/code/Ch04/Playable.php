<?php

declare(strict_types=1);

namespace Course\Ch04;

interface Playable
{
    /** Интерфейс требует свойство только для чтения. */
    public int $seconds { get; }

    /** Реализацию для всех даёт трейт FormatsDuration. */
    public string $duration { get; }

    public function label(): string;
}
