<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\EventHandler;
use Detroit\Core\Domain\Event\DomainEvent;
use Detroit\Tests\Domain\Event\SomethingHappened;

class SomeReactionHandler implements EventHandler
{
    public function handle(DomainEvent|SomethingHappened $event): void
    { 
    }
}
