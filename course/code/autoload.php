<?php

declare(strict_types=1);

/**
 * PSR-4 автозагрузчик для примеров курса: Course\ChNN\Foo -> ChNN/Foo.php.
 * Нужен, чтобы примеры запускались без `composer install`.
 * Ту же карту описывает composer.json рядом.
 */
spl_autoload_register(static function (string $class): void {
    $prefix = 'Course\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';

    if (is_file($file)) {
        require $file;
    }
});
