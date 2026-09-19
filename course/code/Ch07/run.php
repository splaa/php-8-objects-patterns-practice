<?php

declare(strict_types=1);

// Запуск: php course/code/Ch07/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch07\ConsoleOutput;
use Course\Ch07\Exporter;
use Course\Ch07\JsonFormatter;
use Course\Ch07\M3uFormatter;
use Course\Ch07\MemoryOutput;
use Course\Ch07\TightExporter;
use Course\Ch07\Track;

$tracks = [new Track('Coastline', 215), new Track('Drift', 270)];

new TightExporter()->export($tracks, 'm3u');

$console = new ConsoleOutput();
new Exporter(new M3uFormatter(), $console)->export($tracks);
new Exporter(new JsonFormatter(), $console)->export($tracks);

// Новый формат добавляется снаружи — Exporter не меняется.
$csv = new class implements Course\Ch07\Formatter {
    public function format(array $tracks): string
    {
        return implode(PHP_EOL, array_map(static fn (Track $t): string => "{$t->title};{$t->seconds}", $tracks));
    }
};

new Exporter($csv, $console)->export($tracks);

$memory = new MemoryOutput();
new Exporter(new JsonFormatter(), $memory)->export($tracks);
printf('В память записано строк: %d, первая длиной %d символов%s', count($memory->written()), strlen($memory->written()[0]), PHP_EOL);
