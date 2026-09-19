<?php

declare(strict_types=1);

namespace Course\Ch12;

/** Data Mapper: переносит данные между объектами и хранилищем. */
final class TrackMapper
{
    public function __construct(
        private readonly Storage $storage,
        private readonly IdentityMap $identityMap = new IdentityMap(),
    ) {
    }

    public function find(int $id): ?Track
    {
        $known = $this->identityMap->get($id);

        if ($known !== null) {
            return $known;
        }

        $row = $this->storage->selectById($id);

        return $row === null ? null : $this->hydrate($row);
    }

    /** @return list<Track> */
    public function findByAlbum(int $albumId): array
    {
        return array_map(
            fn (array $row): Track => $this->identityMap->get($row['id']) ?? $this->hydrate($row),
            $this->storage->selectByAlbum($albumId),
        );
    }

    public function insert(Track $track): void
    {
        $track->id = $this->storage->insert($track->toRow());
        $this->identityMap->put($track);
    }

    public function update(Track $track): void
    {
        if ($track->id === null) {
            $this->insert($track);

            return;
        }

        $this->storage->update($track->id, $track->toRow());
    }

    /** @param array{id: int, album_id: int, title: string, seconds: int} $row */
    private function hydrate(array $row): Track
    {
        $track = new Track($row['id'], $row['album_id'], $row['title'], $row['seconds']);
        $this->identityMap->put($track);

        return $track;
    }
}
