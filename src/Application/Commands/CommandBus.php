<?php

namespace Detroit\Core\Application\Commands;

interface CommandBus
{
    public function handle(Command $command): ?string;
}
