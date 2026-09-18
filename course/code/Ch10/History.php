<?php

declare(strict_types=1);

namespace Course\Ch10;

use RuntimeException;

final class History
{
    /** @var list<Command> */
    private array $done = [];

    public function run(Command $command): string
    {
        $result = $command->execute();
        $this->done[] = $command;

        return $result;
    }

    public function undoLast(): string
    {
        $command = array_pop($this->done) ?? throw new RuntimeException('Отменять нечего');

        return $command->undo();
    }
}
