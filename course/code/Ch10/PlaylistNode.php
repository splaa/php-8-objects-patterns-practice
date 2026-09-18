<?php

declare(strict_types=1);

namespace Course\Ch10;

interface PlaylistNode
{
    public function accept(NodeVisitor $visitor): void;
}
