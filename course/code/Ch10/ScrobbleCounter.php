<?php

declare(strict_types=1);

namespace Course\Ch10;

final class ScrobbleCounter implements PlayerListener
{
    /** @var array<string, int> */
    private array $counts = [];

    public function trackStarted(Track $track): void
    {
        $this->counts[$track->title] = ($this->counts[$track->title] ?? 0) + 1;
    }

    /** @return array<string, int> */
    public function counts(): array
    {
        return $this->counts;
    }
}
