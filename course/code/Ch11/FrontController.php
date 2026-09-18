<?php

declare(strict_types=1);

namespace Course\Ch11;

use Throwable;

/** Одна точка входа: общая обвязка до и после любого действия. */
final class FrontController
{
    public function __construct(
        private readonly CommandResolver $resolver,
        private readonly Registry $registry,
    ) {
    }

    public function handle(Request $request): string
    {
        $command = $this->resolver->resolve($request);

        try {
            return sprintf('[%s] %s', $command::class, $command->run($request, $this->registry));
        } catch (Throwable $e) {
            return sprintf('[500] %s: %s', $command::class, $e->getMessage());
        }
    }
}
