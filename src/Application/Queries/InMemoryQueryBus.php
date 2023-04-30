<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Queries;

use JsonSerializable;
use Psr\Container\ContainerInterface;

class InMemoryQueryBus implements QueryBus
{
    public function __construct(
        private readonly QueryRepository $queries,
        private readonly ContainerInterface $container)
    {
    }

    public function ask(Query $query): JsonSerializable
    {
        $map = $this->queries->mapFor($query);
        /** @var QueryHandler $handler */
        $handler = $this->container->get($map->handler);

        return $handler->handle($query);
    }
}
