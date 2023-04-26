<?php

declare(strict_types=1);

namespace Detroit\Core\Domain\Repository;

use Detroit\Core\Domain\Aggregate\AggregateRoot;
use Detroit\Core\Domain\Aggregate\AggregateRootId;

interface Repository
{
    /** @return AggregateRoot[] */
    public function seen(): array;

    public function nextIdentity(): AggregateRootId;
}
