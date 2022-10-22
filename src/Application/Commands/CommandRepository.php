<?php

namespace Detroit\Core\Application\Commands;

class CommandRepository
{
    /**
     * @param array<string: string>
     */
    public function __construct(private readonly array $commands)
    {
    }

    public function all(): array
    {
        return array_keys($this->commands);
    }

    public function exists(Command $command): bool
    {
        return array_key_exists(get_class($command), $this->commands);
    }

    public function handlerClassFor(Command $command): string
    {
        if (!$this->exists($command)) {
            throw CommandDoesNotExist::from($command);
        }

        return $this->commands[get_class($command)];
    }
}
