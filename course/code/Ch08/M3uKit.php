<?php

declare(strict_types=1);

namespace Course\Ch08;

final class M3uKit implements FormatKit
{
    public function parser(): Parser
    {
        return new M3uParser();
    }

    public function writer(): Writer
    {
        return new M3uWriter();
    }

    public function name(): string
    {
        return 'm3u';
    }
}
