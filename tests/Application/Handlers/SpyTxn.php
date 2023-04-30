<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\Transaction;

class SpyTxn implements Transaction
{
    public array $calls = [];

    public function start(): void
    {
        $this->calls[] = 'start';
    }

    public function commit(): void
    {
        $this->calls[] = 'commit';
    }

    public function rollback(): void
    {
        $this->calls[] = 'rollback';
    }

    public function hasBeenStarted(): bool
    {
        return \in_array('start', $this->calls, true);
    }

    public function hasBeenCommitted(): bool
    {
        return \in_array('commit', $this->calls, true);
    }
}
