<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Bus;

use Detroit\Core\Application\Command\Command;
use Detroit\Core\Domain\Event\DomainEvent;

interface CommandBus
{
    public function handle(Command|DomainEvent $message): ?string;
}
