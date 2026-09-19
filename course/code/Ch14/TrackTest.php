<?php

declare(strict_types=1);

namespace Course\Ch14;

use Course\Ch05\Quality;
use Course\Ch05\Track;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use TypeError;

final class TrackTest extends TestCase
{
    public function testSizeGrowsWithQuality(): void
    {
        $track = new Track(1, 'Coastline', 215, Quality::Low);

        self::assertSame(2.5, $track->sizeMb());
    }

    public function testWithQualityReturnsCopyAndKeepsOriginal(): void
    {
        $original = new Track(1, 'Coastline', 215, Quality::Low);
        $copy = $original->withQuality(Quality::Lossless);

        self::assertNotSame($original, $copy);
        self::assertSame(Quality::Low, $original->quality);
        self::assertSame(Quality::Lossless, $copy->quality);
    }

    #[DataProvider('lyricsCases')]
    public function testLyricsPreview(?string $lyrics, string $expected): void
    {
        $track = new Track(1, 'Coastline', 215, Quality::Standard, $lyrics);

        self::assertSame($expected, $track->lyricsPreview());
    }

    /** @return iterable<string, array{0: string|null, 1: string}> */
    public static function lyricsCases(): iterable
    {
        yield 'без текста' => [null, 'текста нет'];
        yield 'короткий текст' => ['We walked to the water at dawn', 'We walked to the wat...'];
    }

    public function testStrictTypesRejectString(): void
    {
        $this->expectException(TypeError::class);

        /** @phpstan-ignore-next-line намеренно нарушаем тип */
        new Track(1, 'Coastline', '215');
    }
}
