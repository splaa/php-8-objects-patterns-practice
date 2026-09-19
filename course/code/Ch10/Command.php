<?php

declare(strict_types=1);

namespace Course\Ch10;

/** Command: действие как объект, значит, его можно сохранить и отменить. */
interface Command
{
    public function execute(): string;

    public function undo(): string;
}
