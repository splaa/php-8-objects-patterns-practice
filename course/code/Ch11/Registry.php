<?php

declare(strict_types=1);

namespace Course\Ch11;

use RuntimeException;

/**
 * Registry: одно место, где приложение собирает свои сервисы.
 * Обычный объект, а не статика: его можно создать второй раз в тесте.
 */
final class Registry
{
    /** @var array<class-string, object> */
    private array $services = [];

    public function set(object $service): void
    {
        $this->services[$service::class] = $service;
    }

    /**
     * @template T of object
     * @param class-string<T> $id
     * @return T
     */
    public function get(string $id): object
    {
        $service = $this->services[$id] ?? throw new RuntimeException("Сервис {$id} не зарегистрирован");
        assert($service instanceof $id);

        return $service;
    }
}
