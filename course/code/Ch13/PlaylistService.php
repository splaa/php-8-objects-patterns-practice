<?php

declare(strict_types=1);

namespace Course\Ch13;

final class PlaylistService
{
    /** @var list<string> */
    private array $titles = [];

    public function __construct(private readonly Logger $logger = new NullLogger())
    {
    }

    public function add(string $title): void
    {
        $duplicate = array_any(
            $this->titles,
            static fn (string $known): bool => strcasecmp($known, $title) === 0,
        );

        if ($duplicate) {
            $this->logger->log(LogLevel::Warning, 'Трек {title} уже в плейлисте', ['title' => $title]);

            return;
        }

        $this->titles[] = $title;
        $this->logger->log(LogLevel::Info, 'Добавлен {title}, всего {count}', [
            'title' => $title,
            'count' => count($this->titles),
        ]);
    }

    /** @return list<string> */
    public function titles(): array
    {
        return $this->titles;
    }
}
