<?php

declare(strict_types=1);

namespace Course\Ch09;

/** Декоратор реализует тот же интерфейс и держит ссылку на обёрнутый объект. */
abstract class PlaybackDecorator implements Playback
{
    public function __construct(protected readonly Playback $inner)
    {
    }
}
