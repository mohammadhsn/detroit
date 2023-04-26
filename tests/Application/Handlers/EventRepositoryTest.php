<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\EventMap;
use Detroit\Core\Application\Handlers\EventRepository;
use Detroit\Tests\Domain\Event\SomethingHappened;
use PHPUnit\Framework\TestCase;

class EventRepositoryTest extends TestCase
{
    private EventRepository $repository;

    protected function setUp(): void
    {
        $this->repository = EventRepository::fromMap(
            new EventMap(SomethingHappened::class, [SomeOtherReactionHandler::class])
        );
    }

    public function test_register()
    {
        $this->repository->register(SomethingHappened::class, [SomeOtherReactionHandler::class]);
        $this->assertCount(2, $this->repository->handlersFor(new SomethingHappened('foo', 'bar')));
    }

    public function test_factory()
    {
        $repo = EventRepository::fromEvents([
            new EventMap(SomethingHappened::class, [SomeOtherReactionHandler::class]),
            new EventMap(SomethingHappened::class, [SomeOtherReactionHandler::class]),
        ]);

        $this->assertCount(1, $repo->all());
    }
}
