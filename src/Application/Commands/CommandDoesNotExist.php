<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Exception;

class CommandDoesNotExist extends Exception
{
    public static function from(Command $command): self
    {
        return new static(sprintf('The command %s does not exists', \get_class($command)));
    }
}
