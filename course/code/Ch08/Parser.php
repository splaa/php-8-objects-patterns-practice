<?php

declare(strict_types=1);

namespace Course\Ch08;

interface Parser
{
    /** @return list<Track> */
    public function parse(string $raw): array;
}
