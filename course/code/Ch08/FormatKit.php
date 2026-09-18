<?php

declare(strict_types=1);

namespace Course\Ch08;

/** Abstract Factory: семейство согласованных объектов одного формата. */
interface FormatKit
{
    public function parser(): Parser;

    public function writer(): Writer;

    public function name(): string;
}
