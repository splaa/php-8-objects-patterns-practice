<?php

declare(strict_types=1);

// Запуск: php course/code/Ch06/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch06\ImportFailed;
use Course\Ch06\Importer;
use Course\Ch06\LibraryError;
use Course\Ch06\TrackNotFound;

$importer = new Importer();

$good = $importer->import(['Coastline|215', 'Drift|270']);
printf('Импортировано: %d, лог: %s%s', count($good), implode(' -> ', $importer->log()), PHP_EOL);

$broken = new Importer();

try {
    $broken->import(['Coastline|215', 'Drift;270']);
} catch (ImportFailed $e) {
    echo 'Поймали доменное: ', $e->getMessage(), PHP_EOL;
    echo 'Причина: ', $e->getPrevious()?->getMessage() ?? 'нет', PHP_EOL;
    echo 'Лог источника: ', implode(' -> ', $broken->log()), PHP_EOL;
}

// Порядок catch: от частного к общему.
try {
    throw TrackNotFound::withId('drift-2024');
} catch (TrackNotFound $e) {
    echo 'Частный случай: ', $e->getMessage(), PHP_EOL;
} catch (LibraryError $e) {
    echo 'Сюда уже не дойдёт', PHP_EOL;
}

// Error и Exception — разные ветки, общий предок Throwable.
try {
    intdiv(1, 0);
} catch (DivisionByZeroError $e) {
    echo get_class($e), ' — это Error, а не Exception: ', $e->getMessage(), PHP_EOL;
}
