<?php

declare(strict_types=1);

namespace Course\Ch08;

final class CsvImporter extends Importer
{
    protected function createParser(): Parser
    {
        return new CsvParser();
    }
}
