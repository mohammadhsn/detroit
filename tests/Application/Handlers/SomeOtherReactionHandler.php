<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\EventHandler;
use Detroit\Core\Domain\Event\DomainEvent;
use Detroit\Tests\Domain\Event\SomethingHappened;

class SomeOtherReactionHandler implements EventHandler
{
    public function handle(DomainEvent|SomethingHappened $event): void
    {
        dump(__METHOD__);
    }
}
