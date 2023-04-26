<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\Command;
use Detroit\Core\Application\Handlers\CommandHandler;
use Detroit\Core\Domain\Repository\Repository;
use Detroit\Tests\Domain\Aggregate\DummyAggregateRoot;
use Detroit\Tests\Domain\Repository\DummyRepository;

class DoSomethingHandler implements CommandHandler
{
    public function handle(Command|DoSomething $command, Repository|DummyRepository $repository): ?string
    {
        $repository->persist(
            DummyAggregateRoot::withRecorded($id = $repository->nextIdentity(), $command->attr)
        );

        return $id->value;
    }
}
