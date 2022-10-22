<?php

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\Command;
use Detroit\Core\Application\Commands\CommandHandler;

class DoSomethingHandler implements CommandHandler
{
    public function handle(Command|DoSomething $command): ?string
    {
        return null;
    }
}
