<?php

declare(strict_types=1);

namespace Course\Ch10;

final class Playlist implements PlaylistNode
{
    /** @var list<PlaylistNode> */
    private array $children = [];

    /** Снаружи только читают: переименование идёт через команду. */
    public function __construct(public private(set) string $title)
    {
    }

    public function rename(string $title): void
    {
        $this->title = $title;
    }

    public function add(PlaylistNode $node): void
    {
        $this->children[] = $node;
    }

    public function remove(PlaylistNode $node): void
    {
        $this->children = array_values(array_filter(
            $this->children,
            static fn (PlaylistNode $child): bool => $child !== $node,
        ));
    }

    /** @return list<Track> */
    public function tracks(): array
    {
        return array_values(array_filter(
            $this->children,
            static fn (PlaylistNode $child): bool => $child instanceof Track,
        ));
    }

    public function accept(NodeVisitor $visitor): void
    {
        $visitor->visitPlaylist($this);

        foreach ($this->children as $child) {
            $child->accept($visitor);
        }
    }
}
