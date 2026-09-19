<?php

declare(strict_types=1);

namespace Course\Ch06;

use RuntimeException;

final class TrackNotFound extends RuntimeException implements LibraryError
{
    public static function withId(int|string $id): self
    {
        return new self("Трек {$id} не найден");
    }
}
