<?php

declare(strict_types=1);

// Запуск: php course/code/Ch02/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch02\Track;

$coastline = new Track('Coastline', 'Nadia Rue', 215);
$drift = Track::fromMinutes('Drift', 'Nadia Rue', 4.5);

echo $coastline, PHP_EOL;
echo $drift, PHP_EOL;

$coastline->play();
$coastline->play();
echo "Прослушиваний у «{$coastline->title}»: {$coastline->plays()}", PHP_EOL;

echo 'Создано треков: ', Track::createdCount(), PHP_EOL;
echo 'Потолок длительности, сек: ', Track::MAX_SECONDS, PHP_EOL;

try {
    new Track('Broken', 'Nobody', 0);
} catch (InvalidArgumentException $e) {
    echo 'Конструктор не пропустил мусор: ', $e->getMessage(), PHP_EOL;
}
