<?php

declare(strict_types=1);

// Запуск: php course/code/Ch12/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch12\Album;
use Course\Ch12\Storage;
use Course\Ch12\Track;
use Course\Ch12\TrackMapper;
use Course\Ch12\UnitOfWork;

$storage = new Storage();
$mapper = new TrackMapper($storage);

// Identity Map: второй find() того же трека не идёт в хранилище.
$first = $mapper->find(1);
$second = $mapper->find(1);
var_dump($first === $second);

// Lazy Load: альбом создан, но запроса за треками ещё не было.
$album = new Album(1, 'Coastline EP', static fn (): array => $mapper->findByAlbum(1));
echo 'Альбом создан, запросов: ', count($storage->queries()), PHP_EOL;
printf('%s: %d сек, запросов: %d%s', $album->title, $album->seconds(), count($storage->queries()), PHP_EOL);
$album->tracks();
echo 'После повторного tracks() запросов по-прежнему: ', count($storage->queries()), PHP_EOL;

// Unit of Work: правки копятся и уходят одним коммитом.
$uow = new UnitOfWork($mapper);
$first->rename('Coastline (remaster)');
$uow->registerDirty($first);
$uow->registerDirty($first);
$uow->registerNew(new Track(null, 1, 'Hidden track', 92));

printf('Записей в коммите: %d%s', $uow->commit(), PHP_EOL);

echo 'Журнал хранилища:', PHP_EOL;

foreach ($storage->queries() as $query) {
    echo '  ', $query, PHP_EOL;
}
