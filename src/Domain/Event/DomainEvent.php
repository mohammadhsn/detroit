<?php

declare(strict_types=1);

namespace Detroit\Core\Domain\Event;

use DateTimeImmutable;

abstract class DomainEvent
{
    abstract public function occurredAt(): DateTimeImmutable;
}
