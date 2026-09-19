<?php

declare(strict_types=1);

namespace Course\Ch12;

/**
 * Заглушка вместо базы: массив строк плюс журнал «запросов».
 * В настоящем проекте здесь был бы PDO; идеи главы от этого не меняются.
 */
final class Storage
{
    /** @var array<int, array{id: int, album_id: int, title: string, seconds: int}> */
    private array $rows = [
        1 => ['id' => 1, 'album_id' => 1, 'title' => 'Coastline', 'seconds' => 215],
        2 => ['id' => 2, 'album_id' => 1, 'title' => 'Drift', 'seconds' => 270],
        3 => ['id' => 3, 'album_id' => 2, 'title' => 'Longform', 'seconds' => 4210],
    ];

    private int $nextId = 4;

    /** @var list<string> */
    private array $queries = [];

    /** @return array{id: int, album_id: int, title: string, seconds: int}|null */
    public function selectById(int $id): ?array
    {
        $this->queries[] = "SELECT * FROM track WHERE id = {$id}";

        return $this->rows[$id] ?? null;
    }

    /** @return list<array{id: int, album_id: int, title: string, seconds: int}> */
    public function selectByAlbum(int $albumId): array
    {
        $this->queries[] = "SELECT * FROM track WHERE album_id = {$albumId}";

        return array_values(array_filter($this->rows, static fn (array $row): bool => $row['album_id'] === $albumId));
    }

    /** @param array{album_id: int, title: string, seconds: int} $row */
    public function insert(array $row): int
    {
        $id = $this->nextId++;
        $this->rows[$id] = ['id' => $id, ...$row];
        $this->queries[] = "INSERT INTO track (id) VALUES ({$id})";

        return $id;
    }

    /** @param array{album_id: int, title: string, seconds: int} $row */
    public function update(int $id, array $row): void
    {
        $this->rows[$id] = ['id' => $id, ...$row];
        $this->queries[] = "UPDATE track SET title = '{$row['title']}' WHERE id = {$id}";
    }

    /** @return list<string> */
    public function queries(): array
    {
        return $this->queries;
    }
}
