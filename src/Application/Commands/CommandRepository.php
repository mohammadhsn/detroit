<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

class CommandRepository
{
    private array $commands = [];

    /**
     * @var CommandConfig[] $commands
     */
    public function __construct(array $commands)
    {
        foreach ($commands as $map) {
            $this->register($map);
        }
    }

    public function register(CommandMap $map): self
    {
        $this->commands[$map->command] = $map;
        return $this;
    }

    public function all(): array
    {
        return array_keys($this->commands);
    }

    public function exists(Command $command): bool
    {
        return \array_key_exists(\get_class($command), $this->commands);
    }

    public function mapFor(Command $command): CommandMap
    {
        if (!$this->exists($command)) {
            throw CommandDoesNotExist::from($command);
        }

        return $this->commands[get_class($command)];
    }

    public function handlerClassFor(Command $command): string
    {
        return $this->mapFor($command)->handler;
    }

    public function repoClassFor(Command $command): string
    {
        return $this->mapFor($command)->repo;
    }
}
