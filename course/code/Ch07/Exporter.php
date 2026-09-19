<?php

declare(strict_types=1);

namespace Course\Ch07;

/** Знает одно: взять треки, отдать форматтеру, отдать вывод. */
final class Exporter
{
    public function __construct(
        private readonly Formatter $formatter,
        private readonly Output $output,
    ) {
    }

    /** @param list<Track> $tracks */
    public function export(array $tracks): void
    {
        $this->output->write($this->formatter->format($tracks));
    }
}
