<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

interface TransactionBoundary
{
    public function start(): void;

    public function hasBeenStarted(): bool;

    public function hasBeenCommitted(): bool;

    public function commit(): void;

    public function rollback(): void;
}
