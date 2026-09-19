<?php

declare(strict_types=1);

// Запуск: php course/code/Ch10/run.php

require __DIR__ . '/../autoload.php';

use Course\Ch10\AddTrack;
use Course\Ch10\ByTitle;
use Course\Ch10\History;
use Course\Ch10\LongestFirst;
use Course\Ch10\Player;
use Course\Ch10\PlayerListener;
use Course\Ch10\Playlist;
use Course\Ch10\RenamePlaylist;
use Course\Ch10\ScrobbleCounter;
use Course\Ch10\StatsVisitor;
use Course\Ch10\Track;

$tracks = [new Track('Drift', 270), new Track('Coastline', 215), new Track('Longform', 4210)];

// Strategy + Observer: порядок задаётся стратегией, реакции — подписчиками.
$counter = new ScrobbleCounter();

$echo = new class implements PlayerListener {
    public function trackStarted(Track $track): void
    {
        echo '  играет ', $track->title, PHP_EOL;
    }
};

foreach ([new ByTitle(), new LongestFirst()] as $ordering) {
    echo 'Порядок ', $ordering->name(), ':', PHP_EOL;
    $player = new Player($ordering);
    $player->subscribe($echo);
    $player->subscribe($counter);
    $player->play($tracks);
}

print_r($counter->counts());

// Command: действия как объекты, с историей и отменой.
$playlist = new Playlist('Утро');
$history = new History();

echo $history->run(new AddTrack($playlist, $tracks[0])), PHP_EOL;
echo $history->run(new RenamePlaylist($playlist, 'Вечер')), PHP_EOL;
echo $history->undoLast(), PHP_EOL;
printf('Сейчас: «%s», треков %d%s', $playlist->title, count($playlist->tracks()), PHP_EOL);

// Visitor: обход дерева и новая операция без правки Track/Playlist.
$root = new Playlist('Библиотека');
$morning = new Playlist('Утро');

foreach ($tracks as $track) {
    $morning->add($track);
}

$root->add($morning);
$root->add(new Track('Jingle', 5));

$stats = new StatsVisitor();
$root->accept($stats);
echo $stats->report(), PHP_EOL;
