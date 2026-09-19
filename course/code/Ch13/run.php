<?php

declare(strict_types=1);

// Запуск: php course/code/Ch13/run.php
// Тот же код через автозагрузку Composer: composer -d course/code dump-autoload
// и затем require 'course/code/vendor/autoload.php' вместо строки ниже.

require __DIR__ . '/../autoload.php';

use Course\Ch13\ConsoleLogger;
use Course\Ch13\LogLevel;
use Course\Ch13\NullLogger;
use Course\Ch13\PlaylistService;

$service = new PlaylistService(new ConsoleLogger());
$service->add('Coastline');
$service->add('Drift');
$service->add('coastline');

echo 'Итог: ', implode(', ', $service->titles()), PHP_EOL;

// Тот же сервис с другим логгером — код сервиса не меняется.
$quiet = new PlaylistService(new ConsoleLogger(LogLevel::Error));
$quiet->add('Coastline');
$quiet->add('Coastline');
echo 'Тихий логгер ничего не напечатал выше', PHP_EOL;

$silent = new PlaylistService(new NullLogger());
$silent->add('Longform');
echo 'С NullLogger сервис работает без единой проверки на null: ', implode(', ', $silent->titles()), PHP_EOL;
