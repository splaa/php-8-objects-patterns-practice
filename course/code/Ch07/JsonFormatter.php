<?php

declare(strict_types=1);

namespace Course\Ch07;

final class JsonFormatter implements Formatter
{
    public function format(array $tracks): string
    {
        $rows = array_map(
            static fn (Track $track): array => ['title' => $track->title, 'seconds' => $track->seconds],
            $tracks,
        );

        return json_encode($rows, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }
}
