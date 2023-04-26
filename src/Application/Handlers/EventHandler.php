<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

use Detroit\Core\Domain\Event\DomainEvent;

interface EventHandler
{
    public function handle(DomainEvent $event): void;
}
