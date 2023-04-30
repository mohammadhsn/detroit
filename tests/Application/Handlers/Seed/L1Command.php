<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers\Seed;

use Detroit\Core\Application\Command\Command;

class L1Command implements Command
{
    public function description(): string
    {
        return __METHOD__;
    }
}
