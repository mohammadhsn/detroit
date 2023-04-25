<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Aggregate\Repository;

interface CommandHandler
{
    public function handle(Command $command, Repository $repository): ?string;
}
