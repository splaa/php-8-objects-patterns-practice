<?php

declare(strict_types=1);

namespace Course\Ch06;

use InvalidArgumentException;
use Throwable;

final class Importer
{
    /** @var list<string> */
    private array $log = [];

    /**
     * @param list<string> $lines строки вида "Coastline|215"
     * @return list<array{title: string, seconds: int}>
     */
    public function import(array $lines): array
    {
        $this->log[] = 'открыл источник';
        $tracks = [];

        try {
            foreach ($lines as $number => $line) {
                $tracks[] = $this->parse($line, $number + 1);
            }
        } finally {
            // finally выполняется и при успехе, и при исключении.
            $this->log[] = 'закрыл источник';
        }

        return $tracks;
    }

    /** @return array{title: string, seconds: int} */
    private function parse(string $line, int $number): array
    {
        try {
            $parts = explode('|', $line);

            if (count($parts) !== 2) {
                throw new InvalidArgumentException("Ожидал «название|секунды», получил «{$line}»");
            }

            [$title, $seconds] = $parts;

            if (!ctype_digit($seconds)) {
                throw new InvalidArgumentException("Секунды не число: «{$seconds}»");
            }

            return ['title' => $title, 'seconds' => (int) $seconds];
        } catch (Throwable $cause) {
            // Низкоуровневую причину заворачиваем в доменное исключение, не теряя её.
            throw ImportFailed::atLine($number, $cause);
        }
    }

    /** @return list<string> */
    public function log(): array
    {
        return $this->log;
    }
}
