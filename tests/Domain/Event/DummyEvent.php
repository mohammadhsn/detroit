<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain\Event;

use DateTimeImmutable;
use Detroit\Core\Domain\Event\DomainEvent;

class DummyEvent extends DomainEvent
{
    public function occurredAt(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
