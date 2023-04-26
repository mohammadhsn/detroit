<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

use Detroit\Core\Domain\Repository\Repository;

class CommandMap
{
    use ChecksTypes;

    public function __construct(
        public readonly string $command,
        public readonly string $handler,
        public readonly string $repo
    ) {
        $this->mustImplement($command, Command::class);
        $this->mustImplement($handler, CommandHandler::class);
        $this->mustImplement($repo, Repository::class);
    }
}
