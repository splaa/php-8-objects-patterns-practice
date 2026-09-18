<?php

declare(strict_types=1);

// Запуск: php course/code/Ch03/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch03\Album;
use Course\Ch03\PodcastEpisode;
use Course\Ch03\Source;
use Course\Ch03\Track;

$album = new Album('Coastline EP');
$album->add(new Track('Coastline', 215, Source::file('/music/coastline.flac')));
$album->add(new Track('Drift', 270, Source::stream('https://cdn.example/drift')));
$album->add(new PodcastEpisode('Как писали Coastline', 1800, Source::stream('https://cdn.example/ep7'), 'Студийные байки', 7));

echo $album->playAll(), PHP_EOL;
