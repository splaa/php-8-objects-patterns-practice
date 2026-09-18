<?php

declare(strict_types=1);

namespace Course\Ch12;

use Closure;

/** Lazy Load: треки грузятся при первом обращении, а не при создании альбома. */
final class Album
{
    /** @var list<Track>|null */
    private ?array $tracks = null;

    /** @param Closure(): list<Track> $loader */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        private readonly Closure $loader,
    ) {
    }

    /** @return list<Track> */
    public function tracks(): array
    {
        return $this->tracks ??= ($this->loader)();
    }

    public function seconds(): int
    {
        return array_sum(array_map(static fn (Track $t): int => $t->seconds(), $this->tracks()));
    }
}
