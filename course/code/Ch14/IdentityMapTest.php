<?php

declare(strict_types=1);

namespace Course\Ch14;

use Course\Ch12\Storage;
use Course\Ch12\Track;
use Course\Ch12\TrackMapper;
use Course\Ch12\UnitOfWork;
use PHPUnit\Framework\TestCase;

final class IdentityMapTest extends TestCase
{
    public function testSecondFindDoesNotTouchStorage(): void
    {
        $storage = new Storage();
        $mapper = new TrackMapper($storage);

        $first = $mapper->find(1);
        $second = $mapper->find(1);

        self::assertSame($first, $second);
        self::assertCount(1, $storage->queries());
    }

    public function testUnitOfWorkCollapsesRepeatedChanges(): void
    {
        $storage = new Storage();
        $mapper = new TrackMapper($storage);
        $uow = new UnitOfWork($mapper);

        $track = $mapper->find(1);
        self::assertInstanceOf(Track::class, $track);

        $track->rename('Coastline (remaster)');
        $uow->registerDirty($track);
        $uow->registerDirty($track);

        self::assertSame(1, $uow->commit());
    }
}
