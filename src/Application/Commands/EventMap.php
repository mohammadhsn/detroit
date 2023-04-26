<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Event\DomainEvent;


class EventMap
{
    use ChecksTypes;

    public function __construct(
        public readonly string $event,
        public readonly array $handlers
    )
    {
        $this->mustExtend($event, DomainEvent::class);

        foreach ($handlers as $handler) {
            $this->mustImplement($handler, EventHandler::class);
        }
    }
}
