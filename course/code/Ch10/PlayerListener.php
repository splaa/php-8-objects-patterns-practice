<?php

declare(strict_types=1);

namespace Course\Ch10;

/** Observer: наблюдатель знает про событие, издатель — только про интерфейс. */
interface PlayerListener
{
    public function trackStarted(Track $track): void;
}
