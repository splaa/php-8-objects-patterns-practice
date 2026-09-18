<?php

declare(strict_types=1);

// Запуск: php course/code/Ch08/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch08\CsvImporter;
use Course\Ch08\CsvKit;
use Course\Ch08\FormatKit;
use Course\Ch08\LibraryConfig;
use Course\Ch08\M3uImporter;
use Course\Ch08\M3uKit;
use Course\Ch08\PlaylistTemplate;
use Course\Ch08\Track;

$csv = "Drift;270\nCoastline;215";
$m3u = "#EXTM3U\n#EXTINF:270,Drift\n#EXTINF:215,Coastline";

// Factory Method: общий алгоритм импорта, разный парсер.
foreach ([new CsvImporter(), new M3uImporter()] as $importer) {
    $tracks = $importer->import(match (true) {
        $importer instanceof CsvImporter => $csv,
        default => $m3u,
    });

    printf('%s -> %s%s', $importer::class, implode(', ', array_map(static fn (Track $t): string => $t->title, $tracks)), PHP_EOL);
}

// Abstract Factory: парсер и писатель всегда из одного семейства.
$roundTrip = static function (FormatKit $kit, string $raw): void {
    $tracks = $kit->parser()->parse($raw);
    printf('[%s] %s%s', $kit->name(), str_replace(PHP_EOL, ' / ', $kit->writer()->write($tracks)), PHP_EOL);
};

$roundTrip(new CsvKit(), $csv);
$roundTrip(new M3uKit(), $m3u);

// Prototype: заготовка плюс клон с глубоким копированием.
$template = PlaylistTemplate::of('Утро', [new Track('Coastline', 215)]);
$evening = clone $template;
$evening->title = 'Вечер';
$evening->add(new Track('Drift', 270));

printf('%s: %d трек(ов); %s: %d трек(ов)%s', $template->title, $template->count(), $evening->title, $evening->count(), PHP_EOL);

// Singleton: один экземпляр на процесс.
var_dump(LibraryConfig::instance() === LibraryConfig::instance());
echo 'Формат по умолчанию: ', LibraryConfig::instance()->defaultFormat, PHP_EOL;
