<?php

declare(strict_types=1);

namespace Course\Ch11;

final class NotFound implements AppCommand
{
    public function run(Request $request, Registry $registry): string
    {
        return "404: {$request->path}";
    }
}
