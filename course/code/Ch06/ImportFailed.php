<?php

declare(strict_types=1);

namespace Course\Ch06;

use RuntimeException;
use Throwable;

final class ImportFailed extends RuntimeException implements LibraryError
{
    public static function atLine(int $line, Throwable $cause): self
    {
        return new self("Импорт оборвался на строке {$line}", 0, $cause);
    }
}
