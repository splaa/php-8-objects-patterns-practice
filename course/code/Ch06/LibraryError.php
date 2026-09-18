<?php

declare(strict_types=1);

namespace Course\Ch06;

use Throwable;

/** Маркерный интерфейс: «это наша, доменная проблема». */
interface LibraryError extends Throwable
{
}
