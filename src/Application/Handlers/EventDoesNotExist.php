<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

use Detroit\Core\Domain\Event\DomainEvent;
use Exception;

class EventDoesNotExist extends Exception
{
    public static function from(DomainEvent $event): self
    {
        return new static(sprintf('The event %s does not exists', \get_class($event)));
    }
}
