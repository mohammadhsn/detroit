<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain\Event;

use DateTimeImmutable;
use Detroit\Core\Domain\Event\DomainEvent;

class SomethingHappened extends DomainEvent
{
    public function __construct(
        public readonly string $id,
        public readonly string $attr
    )
    {
    }

    public function occurredAt(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
