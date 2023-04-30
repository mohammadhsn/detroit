<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Queries;

use Detroit\Core\Concerns\ChecksTypes;

class QueryMap
{
    use ChecksTypes;

    public function __construct(
        public readonly string $query,
        public readonly string $handler)
    {
        $this->mustImplement($this->query, Query::class);
        $this->mustImplement($this->handler, QueryHandler::class);
    }
}
