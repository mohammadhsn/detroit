<?php

namespace Detroit\Core\Concerns\BoundedContext;

abstract class Context
{
    protected array $commands;
    protected array $queries;

    public function __construct(
        public readonly string $name,
        public readonly string $path,
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
