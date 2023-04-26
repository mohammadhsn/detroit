<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

interface Command
{
    public function description(): string;
}
