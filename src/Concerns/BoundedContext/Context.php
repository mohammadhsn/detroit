<?php

namespace Detroit\Core\Concerns\BoundedContext;

class Context
{
    public function __construct(
        public readonly string $name,
        public readonly string $path,
        public readonly array $commands,
    ) {}

    protected function pathSeparator(string ...$locations): string
    {
        $path = '';

        foreach ($locations as $location) {
            $path = $location . DIRECTORY_SEPARATOR;
        }

        return rtrim($path, DIRECTORY_SEPARATOR);
    }

    protected function domainPath(): string
    {
        return $this->pathSeparator($this->path, 'Domain');
    }

    protected function applicationPath(): string
    {
        return $this->pathSeparator($this->path, 'Application');
    }

    protected function commandsPath(): string
    {
        return $this->pathSeparator($this->applicationPath(), 'Commands');
    }

    protected function queriesPath(): string
    {
        return $this->pathSeparator($this->applicationPath(), 'Queries');
    }
}
