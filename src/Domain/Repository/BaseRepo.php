<?php

declare(strict_types=1);

namespace Detroit\Core\Domain\Repository;

use Detroit\Core\Domain\Aggregate\AggregateRoot;
use Detroit\Core\Domain\Aggregate\AggregateRootId;

abstract class BaseRepo implements Repository
{
    /** @var AggregateRoot[] */
    private array $seen = [];

    public function seen(): array
    {
        return $this->seen;
    }

    protected function addSeen(AggregateRoot $aggregate): void
    {
        $this->seen[] = $aggregate;
    }

    public function nextIdentity(): AggregateRootId
    {
        return AggregateRootId::fromValue(uniqid());
    }
}
