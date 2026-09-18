<?php

declare(strict_types=1);

namespace Course\Ch07;

interface Output
{
    public function write(string $body): void;
}
