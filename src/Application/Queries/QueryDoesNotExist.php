<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Queries;

use Exception;

class QueryDoesNotExist extends Exception
{
    public static function from(Query $query): self
    {
        return new static(sprintf('Query %s does not exists', \get_class($query)));
    }
}
