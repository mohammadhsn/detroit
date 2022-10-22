<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\CommandDoesNotExist;
use Detroit\Core\Application\Commands\CommandRepository;
use Detroit\Core\Application\Commands\InMemoryCommandBus;
use PHPUnit\Framework\TestCase;

class InMemoryCommandBusTest extends TestCase
{
    private InMemoryCommandBus $bus;

    protected function setUp(): void
    {
        $repo = new CommandRepository([
            DoSomething::class => DoSomethingHandler::class,
        ]);

        $this->bus = new InMemoryCommandBus($repo);
    }

    public function test_handling_a_command()
    {
        $this->assertNull($this->bus->handle(new DoSomething()));
    }

    public function test_handling_an_undefined_command()
    {
        $this->expectException(CommandDoesNotExist::class);
        $this->bus->handle(new DoSomethingElse());
    }
}
