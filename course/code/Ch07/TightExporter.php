<?php

declare(strict_types=1);

namespace Course\Ch07;

use InvalidArgumentException;

/**
 * Как делать не надо: один класс знает про форматы, про вывод и про журнал.
 * Любое из трёх изменений заставляет править этот файл.
 */
final class TightExporter
{
    /** @param list<Track> $tracks */
    public function export(array $tracks, string $format): void
    {
        $body = match ($format) {
            'm3u' => $this->toM3u($tracks),
            'json' => json_encode(
                array_map(static fn (Track $t): array => ['title' => $t->title, 'seconds' => $t->seconds], $tracks),
                JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE,
            ),
            default => throw new InvalidArgumentException("Формат {$format} не поддержан"),
        };

        echo '[жёсткий вариант] ', $body, PHP_EOL;
        file_put_contents('php://stdout', '[журнал] экспорт в ' . $format . PHP_EOL);
    }

    /** @param list<Track> $tracks */
    private function toM3u(array $tracks): string
    {
        $lines = ['#EXTM3U'];

        foreach ($tracks as $track) {
            $lines[] = "#EXTINF:{$track->seconds},{$track->title}";
        }

        return implode(' / ', $lines);
    }
}
