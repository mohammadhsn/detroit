<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain\Repository;

use Detroit\Core\Domain\Repository\BaseRepo;
use Detroit\Tests\Domain\Aggregate\DummyAggregateRoot;

class InMemoryDummyRepo extends BaseRepo implements DummyRepository
{
    public function persist(DummyAggregateRoot $aggregateRoot): void
    {
        $this->addSeen($aggregateRoot);
    }
}
