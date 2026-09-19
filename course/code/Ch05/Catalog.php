<?php

declare(strict_types=1);

namespace Course\Ch05;

use RuntimeException;

final class Catalog
{
    /** @var array<int|string, Track> */
    private array $tracks = [];

    public function add(Track $track): static
    {
        $this->tracks[$track->id] = $track;

        return $this;
    }

    /** Может не найти — и тип это говорит прямо. */
    public function find(int|string $id): ?Track
    {
        return $this->tracks[$id] ?? null;
    }

    /** Не находит — не возвращает никогда: тип never. */
    public function get(int|string $id): Track
    {
        return $this->find($id) ?? $this->missing($id);
    }

    private function missing(int|string $id): never
    {
        throw new RuntimeException("Трек {$id} не найден");
    }
}
