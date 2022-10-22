<?php

namespace Detroit\Core\Application\Queries;

use JsonSerializable;

interface QueryBus
{
    public function ask(Query $query): JsonSerializable;
}
