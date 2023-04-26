<?php

namespace Detroit\Core\Domain\Repository;


use Detroit\Core\Domain\Aggregate\AggregateRoot;
use Detroit\Core\Domain\Aggregate\AggregateRootId;

abstract class BaseRepo implements Repository
{
    /** @var $seen AggregateRoot[] */
    private array $seen = [];

    public function seen(): array
    {
        return $this->seen;
    }

    protected function addSeen(AggregateRoot $aggregate): void
    {
        $this->seen []= $aggregate;
    }

    public function nextIdentity(): AggregateRootId
    {
        return AggregateRootId::fromValue(uniqid());
    }
}
