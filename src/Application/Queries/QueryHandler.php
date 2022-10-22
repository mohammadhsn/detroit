<?php

namespace Detroit\Core\Application\Queries;

use JsonSerializable;

interface QueryHandler
{
    public function handle(Query $query): JsonSerializable;
}
