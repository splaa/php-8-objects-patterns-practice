<?php

declare(strict_types=1);

namespace Course\Ch03;

class Track
{
    public function __construct(
        protected readonly string $title,
        protected readonly int $seconds,
        private readonly Source $source,
    ) {
    }

    public function describe(): string
    {
        return sprintf('%s [%d сек]', $this->title, $this->seconds);
    }

    public function play(): string
    {
        return $this->describe() . ': ' . $this->source->open();
    }
}
