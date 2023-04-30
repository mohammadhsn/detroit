<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers\Seed;

use Detroit\Core\Application\Handlers\Command;
use Detroit\Core\Application\Handlers\CommandHandler;
use Detroit\Core\Domain\Repository\Repository;
use Detroit\Tests\Domain\Aggregate\DummyAggregateRoot;
use Detroit\Tests\Domain\Repository\DummyRepository;

class L3CommandHandler implements CommandHandler
{
    public function handle(Command|L3Command $command, Repository|DummyRepository $repository): ?string
    {
        $agg = new DummyAggregateRoot(
            $repository->nextIdentity(),
            'baz'
        );

        $repository->persist($agg);

        return 'l3';
    }
}
