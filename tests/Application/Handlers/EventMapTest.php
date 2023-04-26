<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\EventMap;
use Detroit\Tests\Domain\Event\SomethingHappened;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EventMapTest extends TestCase
{
    public function test_validation()
    {
        $map = new EventMap(SomethingHappened::class, [SomeOtherReactionHandler::class]);
        $this->assertInstanceOf(EventMap::class, $map);
        $this->expectException(InvalidArgumentException::class);
        new EventMap(SomethingHappened::class, [DoSomethingElse::class]);
        new EventMap(DoSomething::class, [DoSomethingHandler::class]);
    }
}
