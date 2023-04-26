<?php

namespace Detroit\Tests\Domain;

use Detroit\Core\Domain\Aggregate\BaseRepo;
use Detroit\Tests\Domain\Aggregate\DummyAggregateRoot;

class InMemoryDummyRepo extends BaseRepo implements DummyRepository
{
    public function persist(DummyAggregateRoot $aggregateRoot): void
    {
        $this->addSeen($aggregateRoot);
    }
}
