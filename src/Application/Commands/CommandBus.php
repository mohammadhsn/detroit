<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Event\DomainEvent;

interface CommandBus
{
    public function handle(Command|DomainEvent $message): ?string;
}
