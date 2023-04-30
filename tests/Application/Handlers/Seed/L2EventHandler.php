<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers\Seed;

use Detroit\Core\Application\Handlers\CommandBus;
use Detroit\Core\Application\Handlers\EventHandler;
use Detroit\Core\Domain\Event\DomainEvent;
use Detroit\Tests\Domain\Event\SomethingElseHappened;

class L2EventHandler implements EventHandler
{
    public function __construct(private readonly CommandBus $bus)
    {
    }

    public function handle(DomainEvent|SomethingElseHappened $event): void
    {
        $this->bus->handle(new L3Command());
    }
}
