<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\CommandDoesNotExist;
use Detroit\Core\Application\Commands\CommandMap;
use Detroit\Core\Application\Commands\CommandRepository;
use Detroit\Core\Application\Commands\EventRepository;
use Detroit\Core\Application\Commands\InMemoryCommandBus;
use Detroit\Core\Concerns\App\Container;
use Detroit\Tests\Domain\Event\SomethingHappened;
use Detroit\Tests\Domain\InMemoryDummyRepo;
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
