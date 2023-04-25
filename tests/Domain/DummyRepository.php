<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain;

use Detroit\Core\Domain\Aggregate\AggregateRootId;
use Detroit\Core\Domain\Aggregate\Repository;

class DummyRepository implements Repository
{
    public function seen(): array
    {
        return [];
    }

    public function nextIdentity(): AggregateRootId
    {
        return AggregateRootId::fromValue("id-" . mt_rand(1, 100));
    }
}
