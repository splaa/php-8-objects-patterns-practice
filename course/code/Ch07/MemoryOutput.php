<?php

declare(strict_types=1);

namespace Course\Ch07;

/** Тот самый дублёр, ради которого всё затевалось: проверяем результат без экрана и файлов. */
final class MemoryOutput implements Output
{
    /** @var list<string> */
    private array $written = [];

    public function write(string $body): void
    {
        $this->written[] = $body;
    }

    /** @return list<string> */
    public function written(): array
    {
        return $this->written;
    }
}
