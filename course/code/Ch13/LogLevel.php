<?php

declare(strict_types=1);

namespace Course\Ch13;

/** Подмножество уровней PSR-3. */
enum LogLevel: string
{
    case Debug = 'debug';
    case Info = 'info';
    case Warning = 'warning';
    case Error = 'error';

    public function weight(): int
    {
        return match ($this) {
            self::Debug => 10,
            self::Info => 20,
            self::Warning => 30,
            self::Error => 40,
        };
    }
}
