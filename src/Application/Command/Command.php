<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Command;

interface Command
{
    public function description(): string;
}
