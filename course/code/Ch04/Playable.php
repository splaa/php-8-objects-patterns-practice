<?php

declare(strict_types=1);

namespace Course\Ch04;

interface Playable
{
    public function seconds(): int;

    public function label(): string;

    /** Реализацию для всех даёт трейт FormatsDuration. */
    public function duration(): string;
}
