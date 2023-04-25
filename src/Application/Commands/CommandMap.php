<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Aggregate\Repository;
use InvalidArgumentException;
use ReflectionClass;

class CommandMap
{
    public function __construct(
        public readonly string $command,
        public readonly string $handler,
        public readonly string $repo
    )
    {
        $this->mustImplement($command, Command::class);
        $this->mustImplement($handler, CommandHandler::class);
        $this->mustImplement($repo, Repository::class);
    }

    private function mustImplement(string $class, string $interface): void
    {
        $ref = new ReflectionClass($class);

        if (! $ref->implementsInterface($interface)) {
            throw new InvalidArgumentException(
                sprintf("Class %s must implement %s", $class, $interface)
            );
        }
    }
}
