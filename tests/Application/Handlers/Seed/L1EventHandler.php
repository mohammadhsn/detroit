<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers\Seed;

use Detroit\Core\Application\Bus\CommandBus;
use Detroit\Core\Application\Handlers\EventHandler;
use Detroit\Core\Domain\Event\DomainEvent;
use Detroit\Tests\Domain\Event\SomethingHappened;

class L1EventHandler implements EventHandler
{
    public function __construct(private readonly CommandBus $bus)
    {
    }

    public function handle(DomainEvent|SomethingHappened $event): void
    {
        $this->bus->handle(new L2Command());
    }
}
