<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain\Aggregate;

use Detroit\Core\Domain\Aggregate\AggregateRoot;
use Detroit\Tests\Domain\Event\SomethingHappened;

class DummyAggregateRoot extends AggregateRoot
{
    public function doSomething(): void
    {
        $this->record(new SomethingHappened());
    }
}
