<?php

declare(strict_types=1);

// Запуск: php course/code/Ch01/run.php

// Вариант «на массивах»: правила живут в вызывающем коде и расползаются по проекту.
$rawTrack = ['title' => 'Coastline', 'seconds' => 215];

function formatRawTrack(array $track): string
{
    return sprintf('%s (%d:%02d)', $track['title'], intdiv($track['seconds'], 60), $track['seconds'] % 60);
}

// Вариант «на объекте»: данные и правило форматирования лежат в одном месте.
final class Track
{
    public function __construct(
        public readonly string $title,
        public readonly int $seconds,
    ) {
    }

    public function format(): string
    {
        return sprintf('%s (%d:%02d)', $this->title, intdiv($this->seconds, 60), $this->seconds % 60);
    }
}

echo formatRawTrack($rawTrack), PHP_EOL;
echo new Track('Coastline', 215)->format(), PHP_EOL;

// Массив легко испортить незаметно, объект — нет.
$rawTrack['secons'] = 300;
echo formatRawTrack($rawTrack), PHP_EOL;

try {
    $track = new Track('Coastline', 215);
    $track->seconds = 300;
} catch (Error $e) {
    echo 'Объект защитил данные: ', $e->getMessage(), PHP_EOL;
}
