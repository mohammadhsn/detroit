<?php

declare(strict_types=1);

namespace Detroit\Core\Domain\Aggregate;

interface Repository
{
    /** @return AggregateRoot[] */
    public function seen(): array;

    public function nextIdentity(): AggregateRootId;
}
