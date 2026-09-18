<?php

declare(strict_types=1);

namespace Course\Ch04;

abstract class MediaItem implements Playable
{
    use FormatsDuration;

    public function __construct(
        protected readonly string $title,
        protected readonly int $seconds,
    ) {
    }

    final public function seconds(): int
    {
        return $this->seconds;
    }

    /** Наследник обязан сказать, как он представляется. */
    abstract public function label(): string;
}
