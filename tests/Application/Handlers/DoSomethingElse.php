<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\Command;

class DoSomethingElse implements Command
{
    public function description(): string
    {
        return 'Another dummy command for test purposes';
    }
}
