<?php

declare(strict_types=1);

namespace Course\Ch13;

/**
 * Интерфейс по мотивам PSR-3: сообщение с плейсхолдерами {name} плюс контекст.
 * В боевом коде подключают psr/log, а не пишут свой.
 */
interface Logger
{
    /** @param array<string, string|int> $context */
    public function log(LogLevel $level, string $message, array $context = []): void;
}
