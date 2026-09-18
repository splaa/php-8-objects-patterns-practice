<?php

declare(strict_types=1);

namespace Course\Ch14;

use Course\Ch05\Catalog;
use Course\Ch05\Track;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class CatalogTest extends TestCase
{
    private Catalog $catalog;

    protected function setUp(): void
    {
        $this->catalog = (new Catalog())
            ->add(new Track(1, 'Coastline', 215))
            ->add(new Track('drift-2024', 'Drift', 270));
    }

    public function testFindReturnsNullForUnknownId(): void
    {
        self::assertNull($this->catalog->find('нет такого'));
    }

    public function testFindReturnsStoredTrack(): void
    {
        self::assertSame('Drift', $this->catalog->find('drift-2024')?->title);
    }

    public function testGetThrowsForUnknownId(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Трек 42 не найден');

        $this->catalog->get(42);
    }
}
