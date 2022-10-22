<?php

namespace Detroit\Core\Domain\Event;

use DateTimeImmutable;

abstract class DomainEvent
{
    abstract public function occurredAt(): DateTimeImmutable;
}
