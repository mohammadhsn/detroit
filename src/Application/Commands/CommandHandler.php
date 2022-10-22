<?php

namespace Detroit\Core\Application\Command;

interface CommandHandler
{
    public function handle(Command $command): ?string;
}
