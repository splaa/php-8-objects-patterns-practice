<?php

declare(strict_types=1);

namespace Course\Ch03;

use InvalidArgumentException;

/** Откуда берётся звук. Отдельный объект вместо отдельного подкласса трека. */
final class Source
{
    private function __construct(
        private readonly string $kind,
        private readonly string $location,
    ) {
    }

    public static function file(string $path): self
    {
        return new self('file', $path);
    }

    public static function stream(string $url): self
    {
        return new self('stream', $url);
    }

    public function open(): string
    {
        return match ($this->kind) {
            'file' => "читаю файл {$this->location}",
            'stream' => "подключаюсь к потоку {$this->location}",
            default => throw new InvalidArgumentException("Неизвестный источник: {$this->kind}"),
        };
    }
}
