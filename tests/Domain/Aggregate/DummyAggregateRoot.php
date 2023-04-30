<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain\Aggregate;

use Detroit\Core\Domain\Aggregate\AggregateRoot;
use Detroit\Core\Domain\Aggregate\AggregateRootId;
use Detroit\Tests\Domain\Event\SomethingElseHappened;
use Detroit\Tests\Domain\Event\SomethingHappened;

class DummyAggregateRoot extends AggregateRoot
{
    public function __construct(
        public readonly AggregateRootId $id,
        public readonly string $attr
    ) {
    }

    public static function withSomethingHappened(AggregateRootId $id, string $attr): self
    {
        $aggregate = new self($id, $attr);
        $aggregate->record(new SomethingHappened($id->value, $attr));

        return $aggregate;
    }

    public static function withSomethingElseHappened(AggregateRootId $id, string $attr): self
    {
        $aggregate = new self($id, $attr);
        $aggregate->record(new SomethingElseHappened($id->value, $attr));

        return $aggregate;
    }
}
