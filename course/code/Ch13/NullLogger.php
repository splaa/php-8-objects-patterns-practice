<?php

declare(strict_types=1);

namespace Course\Ch13;

/** Заглушка по умолчанию: сервису не нужно проверять $logger на null. */
final class NullLogger implements Logger
{
    public function log(LogLevel $level, string $message, array $context = []): void
    {
    }
}
