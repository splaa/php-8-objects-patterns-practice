<?php

declare(strict_types=1);

// Запуск: php course/code/Ch11/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch11\CommandResolver;
use Course\Ch11\FrontController;
use Course\Ch11\PlaylistRepository;
use Course\Ch11\Registry;
use Course\Ch11\Request;

// Точка сборки: всё, что нужно приложению, создаётся здесь.
$registry = new Registry();
$registry->set(new PlaylistRepository());

$app = new FrontController(new CommandResolver(), $registry);

$requests = [
    new Request('/playlist', ['slug' => 'morning']),
    new Request('/playlist/add', ['slug' => 'morning', 'title' => 'Longform']),
    new Request('/playlist', ['slug' => 'morning']),
    new Request('/playlist/add', ['slug' => 'morning']),
    new Request('/tracks/42'),
];

foreach ($requests as $request) {
    echo $app->handle($request), PHP_EOL;
}

// Сервис не зарегистрирован — падение ловит фронт-контроллер, а не пользователь.
echo (new FrontController(new CommandResolver(), new Registry()))
    ->handle(new Request('/playlist')), PHP_EOL;
