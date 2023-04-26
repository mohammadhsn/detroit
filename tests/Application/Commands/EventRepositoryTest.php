<?php

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\EventMap;
use Detroit\Core\Application\Commands\EventRepository;
use Detroit\Tests\Domain\Event\DummyEvent;
use PHPUnit\Framework\TestCase;

class EventRepositoryTest extends TestCase
{
    private EventRepository $repository;

    protected function setUp(): void
    {
        $this->repository = EventRepository::fromMap(
            new EventMap(DummyEvent::class, [DummyEventHandler::class])
        );
    }

    public function test_register()
    {
        $this->repository->register(DummyEvent::class, [DummyEventHandler::class]);
        $this->assertCount(2, $this->repository->handlersFor(new DummyEvent));
    }

    public function test_factory()
    {
        $repo = EventRepository::fromEvents([
            new EventMap(DummyEvent::class, [DummyEventHandler::class]),
            new EventMap(DummyEvent::class, [DummyEventHandler::class]),
        ]);

        $this->assertCount(1, $repo->all());
    }
}
