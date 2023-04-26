<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\CommandDoesNotExist;
use Detroit\Core\Application\Handlers\CommandMap;
use Detroit\Core\Application\Handlers\CommandRepository;
use Detroit\Core\Application\Handlers\EventRepository;
use Detroit\Core\Application\Handlers\InMemoryCommandBus;
use Detroit\Core\Concerns\Container;
use Detroit\Tests\Domain\Event\SomethingHappened;
use Detroit\Tests\Domain\Repository\InMemoryDummyRepo;
use PHPUnit\Framework\TestCase;

class InMemoryCommandBusTest extends TestCase
{
    private InMemoryCommandBus $bus;

    protected function setUp(): void
    {
        $commands = CommandRepository::fromMap(
            new CommandMap(DoSomething::class, DoSomethingHandler::class, InMemoryDummyRepo::class)
        );

        $this->bus = new InMemoryCommandBus(
            $commands, new EventRepository(), new Container()
        );
    }

    public function test_handling_a_command()
    {
        $this->bus->handle(new DoSomething('hi'));

        $this->assertCount(1, $this->bus->records);

        $this->assertInstanceOf(SomethingHappened::class, array_pop($this->bus->records));
    }

    public function test_handling_an_undefined_command()
    {
        $this->expectException(CommandDoesNotExist::class);
        $this->bus->handle(new DoSomethingElse());
    }
}
