<?php

declare(strict_types=1);

// Запуск: php course/code/Ch04/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch04\Jingle;
use Course\Ch04\Playable;
use Course\Ch04\Player;
use Course\Ch04\Track;

$queue = [
    new Track('Coastline', 215, 'Nadia Rue'),
    new Jingle('Кофейня «Якорь»'),
    new Track('Longform', 4210, 'Nadia Rue'),
];

echo new Player($queue)->run(), PHP_EOL;

// Плееру важен только интерфейс, а не иерархия классов.
foreach ($queue as $item) {
    printf(
        '%s: Playable=%s, MediaItem=%s%s',
        $item->label(),
        $item instanceof Playable ? 'да' : 'нет',
        $item instanceof Course\Ch04\MediaItem ? 'да' : 'нет',
        PHP_EOL,
    );
}
