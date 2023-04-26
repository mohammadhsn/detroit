<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\Command;

class DoSomething implements Command
{
    public function __construct(public readonly string $attr)
    {
    }

    public function description(): string
    {
        return 'A dummy command for test purposes';
    }
}
