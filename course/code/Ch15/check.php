<?php

declare(strict_types=1);

// Запуск: php course/code/Ch15/check.php
// Или через Composer: composer -d course/code lint

$root = dirname(__DIR__);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS));
$problems = [];
$checked = 0;

foreach ($files as $file) {
    if (!$file instanceof SplFileInfo || $file->getExtension() !== 'php') {
        continue;
    }

    $path = $file->getPathname();

    if (str_contains($path, '/vendor/')) {
        continue;
    }

    $checked++;
    $output = [];
    $status = 0;
    exec(escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($path) . ' 2>&1', $output, $status);

    match (true) {
        $status !== 0 => $problems[] = "синтаксис: {$path}: " . implode(' ', $output),
        !str_contains((string) file_get_contents($path), 'declare(strict_types=1)') => $problems[] = "нет strict_types: {$path}",
        default => null,
    };
}

printf('Проверено файлов: %d%s', $checked, PHP_EOL);

foreach ($problems as $problem) {
    echo '  ', $problem, PHP_EOL;
}

echo $problems === [] ? 'Всё чисто' : 'Проблем: ' . count($problems), PHP_EOL;

exit($problems === [] ? 0 : 1);
