<?php

declare(strict_types=1);

// Запуск: php course/code/Ch05/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch05\Catalog;
use Course\Ch05\Quality;
use Course\Ch05\Track;

$catalog = new Catalog()
    ->add(new Track(1, 'Coastline', 215, Quality::Lossless, 'We walked to the water at dawn'))
    ->add(new Track('drift-2024', 'Drift', 270));

foreach (['1', 1, 'drift-2024', 'нет такого'] as $id) {
    $track = $catalog->find($id);
    printf(
        'find(%s) -> %s%s',
        var_export($id, true),
        $track === null ? 'null' : $track->title,
        PHP_EOL,
    );
}

$coastline = $catalog->get(1);
printf('%s: %s, %d кбит/с, %.1f МБ%s', $coastline->title, $coastline->quality->value, $coastline->quality->bitrate(), $coastline->sizeMb(), PHP_EOL);
echo $coastline->lyricsPreview(), PHP_EOL;

$low = $coastline->withQuality(Quality::Low);
printf('копия: %.1f МБ, оригинал: %.1f МБ%s', $low->sizeMb(), $coastline->sizeMb(), PHP_EOL);

echo $catalog->get('drift-2024')->lyricsPreview(), PHP_EOL;

// strict_types=1: строка вместо int не превращается в число молча.
try {
    new Track(2, 'Broken types', '215');
} catch (TypeError $e) {
    echo 'TypeError: ', explode(',', $e->getMessage())[0], PHP_EOL;
}

try {
    $catalog->get(42);
} catch (RuntimeException $e) {
    echo 'never-ветка сработала: ', $e->getMessage(), PHP_EOL;
}
