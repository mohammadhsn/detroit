<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Queries;

use JsonSerializable;

interface QueryHandler
{
    public function handle(Query $query): JsonSerializable;
}
