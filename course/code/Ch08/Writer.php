<?php

declare(strict_types=1);

namespace Course\Ch08;

interface Writer
{
    /** @param list<Track> $tracks */
    public function write(array $tracks): string;
}
