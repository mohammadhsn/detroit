<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\CommandMap;
use Detroit\Tests\Domain\DummyRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CommandMapTest extends TestCase
{
    public function test_validation()
    {
        $map = new CommandMap(
            DoSomething::class,
            DoSomethingHandler::class,
            DummyRepository::class,
        );

        $this->assertInstanceOf(CommandMap::class, $map);

        $this->expectException(InvalidArgumentException::class);

        new CommandMap(
            DummyRepository::class,
            DoSomethingHandler::class,
            DoSomething::class,
        );
    }
}
