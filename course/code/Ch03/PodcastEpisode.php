<?php

declare(strict_types=1);

namespace Course\Ch03;

final class PodcastEpisode extends Track
{
    public function __construct(
        string $title,
        int $seconds,
        Source $source,
        private readonly string $show,
        private readonly int $number,
    ) {
        parent::__construct($title, $seconds, $source);
    }

    public function describe(): string
    {
        return sprintf('%s #%d: %s', $this->show, $this->number, parent::describe());
    }
}
