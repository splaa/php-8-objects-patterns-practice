<?php

declare(strict_types=1);

namespace Course\Ch09;

final class FadeIn extends PlaybackDecorator
{
    public function __construct(Playback $inner, private readonly int $seconds)
    {
        parent::__construct($inner);
    }

    public function play(): string
    {
        return $this->inner->play() . " -> нарастание {$this->seconds} сек";
    }
}
