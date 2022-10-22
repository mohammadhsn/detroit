<?php

namespace Detroit\Core\Application\Commands;

interface CommandBus
{
    public function handler(Command $command): ?string;
}
