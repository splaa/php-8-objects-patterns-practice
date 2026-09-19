<?php

declare(strict_types=1);

namespace Course\Ch08;

final class CsvKit implements FormatKit
{
    public function parser(): Parser
    {
        return new CsvParser();
    }

    public function writer(): Writer
    {
        return new CsvWriter();
    }

    public function name(): string
    {
        return 'csv';
    }
}
