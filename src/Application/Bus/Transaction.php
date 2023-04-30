<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Bus;

interface Transaction
{
    public function start(): void;

    public function hasBeenStarted(): bool;

    public function hasBeenCommitted(): bool;

    public function commit(): void;

    public function rollback(): void;
}
