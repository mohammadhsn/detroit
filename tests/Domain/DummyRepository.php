<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain;

use Detroit\Core\Domain\Repository\Repository;
use Detroit\Tests\Domain\Aggregate\DummyAggregateRoot;

interface DummyRepository extends Repository
{
    public function persist(DummyAggregateRoot $aggregateRoot): void;
}
