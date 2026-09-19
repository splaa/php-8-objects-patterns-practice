<?php

declare(strict_types=1);

namespace Course\Ch08;

/** Singleton: показываем, как он устроен, и почему им не стоит злоупотреблять. */
final class LibraryConfig
{
    private static ?self $instance = null;

    private function __construct(public readonly string $defaultFormat)
    {
    }

    public static function instance(): self
    {
        return self::$instance ??= new self('m3u');
    }
}
