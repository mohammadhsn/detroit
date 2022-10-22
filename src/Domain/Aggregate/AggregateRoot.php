<?php

namespace Detroit\Core\Domain\Aggregate;

use Detroit\Core\Domain\Event\DomainEvent;

abstract class AggregateRoot
{
    protected array $events = [];

    protected function record(DomainEvent $event): void
    {
        $this->events []= $event;
    }

    public function pullRecordedEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}
