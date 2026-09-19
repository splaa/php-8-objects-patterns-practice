<?php

declare(strict_types=1);

namespace Course\Ch13;

final class ConsoleLogger implements Logger
{
    public function __construct(private readonly LogLevel $minimum = LogLevel::Info)
    {
    }

    public function log(LogLevel $level, string $message, array $context = []): void
    {
        if ($level->weight() < $this->minimum->weight()) {
            return;
        }

        $replacements = [];

        foreach ($context as $key => $value) {
            $replacements['{' . $key . '}'] = (string) $value;
        }

        printf('[%s] %s%s', $level->value, strtr($message, $replacements), PHP_EOL);
    }
}
