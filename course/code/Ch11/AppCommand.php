<?php

declare(strict_types=1);

namespace Course\Ch11;

/** Одно действие приложения. Не знает ни про маршруты, ни про вывод. */
interface AppCommand
{
    public function run(Request $request, Registry $registry): string;
}
