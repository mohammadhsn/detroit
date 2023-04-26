<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

class CommandRepository
{
    private array $commands = [];

    /**
     * @param CommandMap[] $commands
     */
    public static function fromCommands(array $commands): self
    {
        $repo = new static();

        foreach ($commands as $map) {
            $repo->register($map);
        }

        return $repo;
    }

    public static function fromMap(CommandMap $map): self
    {
        return (new static())->register($map);
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
