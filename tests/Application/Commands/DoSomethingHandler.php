<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\Command;
use Detroit\Core\Application\Commands\CommandHandler;
use Detroit\Core\Domain\Aggregate\Repository;
use Detroit\Tests\Domain\Aggregate\DummyAggregateRoot;
use Detroit\Tests\Domain\DummyRepository;

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
