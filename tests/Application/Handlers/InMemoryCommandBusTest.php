<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\CommandDoesNotExist;
use Detroit\Core\Application\Handlers\CommandMap;
use Detroit\Core\Application\Handlers\CommandRepository;
use Detroit\Core\Application\Handlers\EventMap;
use Detroit\Core\Application\Handlers\EventRepository;
use Detroit\Core\Application\Handlers\InMemoryCommandBus;
use Detroit\Core\Concerns\Container;
use Detroit\Tests\Application\Handlers\Seed\L1Command;
use Detroit\Tests\Application\Handlers\Seed\L1CommandHandler;
use Detroit\Tests\Application\Handlers\Seed\L1EventHandler;
use Detroit\Tests\Application\Handlers\Seed\L2Command;
use Detroit\Tests\Application\Handlers\Seed\L2CommandHandler;
use Detroit\Tests\Application\Handlers\Seed\L2EventHandler;
use Detroit\Tests\Application\Handlers\Seed\L3Command;
use Detroit\Tests\Application\Handlers\Seed\L3CommandHandler;
use Detroit\Tests\Domain\Event\SomethingElseHappened;
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

        $events = EventRepository::fromMap(
            new EventMap(SomethingHappened::class, [SomeReactionHandler::class, SomeOtherReactionHandler::class])
        );

        $this->bus = new InMemoryCommandBus(
            $commands, $events, new Container()
        );
    }

    public function test_handling_a_command()
    {
        $this->bus->handle(new DoSomething('hi'));
        $this->assertInstanceOf(SomethingHappened::class, array_pop($this->bus->proceed));
    }

    public function test_handling_an_undefined_command()
    {
        $this->expectException(CommandDoesNotExist::class);
        $this->bus->handle(new DoSomethingElse());
    }

    public function test_multilevel_commands()
    {
        $commands = CommandRepository::fromCommands([
            new CommandMap(L1Command::class, L1CommandHandler::class, InMemoryDummyRepo::class),
            new CommandMap(L2Command::class, L2CommandHandler::class, InMemoryDummyRepo::class),
            new CommandMap(L3Command::class, L3CommandHandler::class, InMemoryDummyRepo::class),
        ]);

        $events = EventRepository::fromEvents([
            new EventMap(SomethingHappened::class, [L1EventHandler::class]),
            new EventMap(SomethingElseHappened::class, [L2EventHandler::class]),
        ]);

        $bus = new InMemoryCommandBus($commands, $events, new Container());

        $bus->handle(new L1Command());

        $this->assertCount(3, $bus->results);

        $this->assertSame('l1', $bus->results[0]->result);
        $this->assertSame('l2', $bus->results[1]->result);
        $this->assertSame('l3', $bus->results[2]->result);
    }
}
