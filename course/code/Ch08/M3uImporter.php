<?php

declare(strict_types=1);

namespace Course\Ch08;

final class M3uImporter extends Importer
{
    protected function createParser(): Parser
    {
        return new M3uParser();
    }
}
