<?php

declare(strict_types=1);

namespace Course\Ch09;

final class Playlist implements PlaylistNode
{
    /** @var list<PlaylistNode> */
    private array $children = [];

    /** Рекурсия без instanceof: ветка и лист отвечают одинаково. */
    public int $seconds {
        get => array_sum(array_map(static fn (PlaylistNode $n): int => $n->seconds, $this->children));
    }

    public function __construct(public readonly string $title)
    {
    }

    public function add(PlaylistNode $node): self
    {
        $this->children[] = $node;

        return $this;
    }

    public function render(int $depth = 0): string
    {
        $head = str_repeat('  ', $depth) . "* {$this->title} ({$this->seconds} сек)";
        $rest = array_map(static fn (PlaylistNode $n): string => $n->render($depth + 1), $this->children);

        return implode(PHP_EOL, [$head, ...$rest]);
    }
}
