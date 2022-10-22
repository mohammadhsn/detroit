<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

interface CommandHandler
{
    public function handle(Command $command): ?string;
}
