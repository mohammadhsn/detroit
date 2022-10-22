<?php

namespace Detroit\Core\Application\Commands;

interface CommandHandler
{
    public function handle(Command $command): ?string;
}
