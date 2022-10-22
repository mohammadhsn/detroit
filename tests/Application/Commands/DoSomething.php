<?php

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\Command;

class DoSomething implements Command
{
    public function description(): string
    {
        return "A dummy command for test purposes";
    } 
}
