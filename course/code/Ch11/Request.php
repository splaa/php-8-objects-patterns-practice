<?php

declare(strict_types=1);

namespace Course\Ch11;

final class Request
{
    /** @param array<string, string> $params */
    public function __construct(
        public readonly string $path,
        public readonly array $params = [],
    ) {
    }

    public function param(string $name, string $default = ''): string
    {
        return $this->params[$name] ?? $default;
    }
}
