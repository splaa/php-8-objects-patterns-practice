<?php

declare(strict_types=1);

namespace Course\Ch12;

use ReflectionClass;

/** Lazy Load на механике PHP 8.4: объект-призрак грузит себя при первом обращении. */
final class AlbumMapper
{
    /** @var ReflectionClass<Album> */
    private readonly ReflectionClass $reflector;

    public function __construct(private readonly TrackMapper $tracks)
    {
        $this->reflector = new ReflectionClass(Album::class);
    }

    public function lazy(int $id, string $title): Album
    {
        return $this->reflector->newLazyGhost(function (Album $album) use ($id, $title): void {
            $album->__construct($id, $title, $this->tracks->findByAlbum($id));
        });
    }
}
