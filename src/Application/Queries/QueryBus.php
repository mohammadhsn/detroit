<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Queries;

use JsonSerializable;

interface QueryBus
{
    public function ask(Query $query): JsonSerializable;
}
