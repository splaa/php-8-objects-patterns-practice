<?php

declare(strict_types=1);

namespace Course\Ch07;

interface Formatter
{
    /** @param list<Track> $tracks */
    public function format(array $tracks): string;
}
