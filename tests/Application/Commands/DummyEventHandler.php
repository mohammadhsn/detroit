<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\EventHandler;
use Detroit\Core\Domain\Event\DomainEvent;

class DummyEventHandler implements EventHandler
{
    public function handle(DomainEvent $event): void
    { 
    } 
}
