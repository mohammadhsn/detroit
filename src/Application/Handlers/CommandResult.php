<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

class CommandResult
{
    public function __construct(
        public readonly Command $command,
        public readonly ?string $result
    ) {
    }
}
