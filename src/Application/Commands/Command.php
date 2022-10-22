<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

interface Command
{
    public function description(): string;
}
