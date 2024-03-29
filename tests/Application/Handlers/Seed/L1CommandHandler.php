<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers\Seed;

use Detroit\Core\Application\Command\Command;
use Detroit\Core\Application\Handlers\CommandHandler;
use Detroit\Core\Domain\Repository\Repository;
use Detroit\Tests\Domain\Aggregate\DummyAggregateRoot;
use Detroit\Tests\Domain\Repository\DummyRepository;

class L1CommandHandler implements CommandHandler
{
    public function handle(Command|L1Command $command, Repository|DummyRepository $repository): ?string
    {
        $agg = DummyAggregateRoot::withSomethingHappened(
            $repository->nextIdentity(), 'foo'
        );

        $repository->persist($agg);

        return 'l1';
    }
}
