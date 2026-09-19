<?php

declare(strict_types=1);

namespace Course\Ch10;

final class RenamePlaylist implements Command
{
    private string $previous;

    public function __construct(
        private readonly Playlist $playlist,
        private readonly string $title,
    ) {
        $this->previous = $playlist->title;
    }

    public function execute(): string
    {
        $this->previous = $this->playlist->title;
        $this->playlist->rename($this->title);

        return "переименовал в «{$this->title}»";
    }

    public function undo(): string
    {
        $this->playlist->rename($this->previous);

        return "вернул название «{$this->previous}»";
    }
}
