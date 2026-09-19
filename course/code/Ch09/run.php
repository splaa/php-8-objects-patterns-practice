<?php

declare(strict_types=1);

// Запуск: php course/code/Ch09/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch09\FadeIn;
use Course\Ch09\LibraryFacade;
use Course\Ch09\Normalized;
use Course\Ch09\Playlist;
use Course\Ch09\RawPlayback;
use Course\Ch09\Track;

// Composite: дерево из плейлистов и треков, считается одинаково на любом уровне.
$morning = new Playlist('Утро')
    ->add(new Track('Coastline', 215))
    ->add(new Track('Drift', 270));

$road = new Playlist('Дорога')
    ->add($morning)
    ->add(new Track('Longform', 4210));

echo $road->render(), PHP_EOL;
printf('Итого в «%s»: %d сек%s%s', $road->title, $road->seconds, PHP_EOL, PHP_EOL);

// Decorator: поведение наращивается снаружи, порядок обёрток виден в выводе.
echo new RawPlayback($morning)->play(), PHP_EOL;
echo new Normalized(new RawPlayback($morning))->play(), PHP_EOL;
echo new FadeIn(new Normalized(new RawPlayback($morning)), 3)->play(), PHP_EOL;
echo PHP_EOL;

// Facade: вызывающему не нужно знать ни про дерево, ни про обёртки.
echo new LibraryFacade()->eveningMix([
    'Coastline EP' => ['Coastline' => 215, 'Drift' => 270],
    'Night tapes' => ['Longform' => 4210],
]), PHP_EOL;
