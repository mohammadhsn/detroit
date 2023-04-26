<?php

namespace Detroit\Core\Domain\Aggregate;


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
