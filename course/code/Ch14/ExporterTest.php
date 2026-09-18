<?php

declare(strict_types=1);

namespace Course\Ch14;

use Course\Ch07\Exporter;
use Course\Ch07\Formatter;
use Course\Ch07\JsonFormatter;
use Course\Ch07\MemoryOutput;
use Course\Ch07\Track;
use PHPUnit\Framework\TestCase;

final class ExporterTest extends TestCase
{
    public function testWritesFormattedBodyToOutput(): void
    {
        $output = new MemoryOutput();

        (new Exporter(new JsonFormatter(), $output))->export([new Track('Coastline', 215)]);

        self::assertSame(['[{"title":"Coastline","seconds":215}]'], $output->written());
    }

    /** Заглушка на анонимном классе: проверяем, что экспортёр не трогает результат форматтера. */
    public function testPassesFormatterResultUnchanged(): void
    {
        $formatter = new class implements Formatter {
            public function format(array $tracks): string
            {
                return 'что угодно';
            }
        };

        $output = new MemoryOutput();
        (new Exporter($formatter, $output))->export([]);

        self::assertSame(['что угодно'], $output->written());
    }

    /** Mock из PHPUnit: проверяем сам факт и количество вызовов. */
    public function testFormatterIsCalledOnce(): void
    {
        $formatter = $this->createMock(Formatter::class);
        $formatter->expects(self::once())
            ->method('format')
            ->willReturn('тело');

        (new Exporter($formatter, new MemoryOutput()))->export([new Track('Drift', 270)]);
    }
}
