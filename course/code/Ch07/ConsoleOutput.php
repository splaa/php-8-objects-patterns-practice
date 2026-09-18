<?php

declare(strict_types=1);

namespace Course\Ch07;

final class ConsoleOutput implements Output
{
    public function write(string $body): void
    {
        echo $body, PHP_EOL;
    }
}
