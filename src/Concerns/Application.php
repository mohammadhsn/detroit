<?php

namespace Detroit\Core\Concerns;

use Detroit\Core\Application\Commands\CommandBus;
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
    ) {}

    public function commandBus(): CommandBus
    {

    }

    public function queryBus(): QueryBus
    {

    }
}
