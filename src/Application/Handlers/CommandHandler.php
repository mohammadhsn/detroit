<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

use Detroit\Core\Application\Command\Command;
use Detroit\Core\Domain\Repository\Repository;

interface CommandHandler
{
    public function handle(Command $command, Repository $repository): ?string;
}
