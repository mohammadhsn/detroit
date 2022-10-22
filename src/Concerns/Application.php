<?php

declare(strict_types=1);

namespace Detroit\Core\Concerns;

use Detroit\Core\Application\Commands\CommandBus;
use Detroit\Core\Application\Commands\CommandRepository;
use Detroit\Core\Application\Commands\InMemoryCommandBus;
use Detroit\Core\Application\Queries\QueryBus;

class Application
{
    /**
     * @param $name string
     * @param $contexts []Context
     */
    public function __construct(
        public readonly string $name,
        public readonly array $contexts
    ) {
    }

    public function commandBus(): CommandBus
    {
        $commands = [];

        foreach ($this->contexts as $context) {
            $commands += $context->commands;
        }

        return new InMemoryCommandBus(
            new CommandRepository($commands)
        );
    }

    public function queryBus(): QueryBus
    {
    }
}
