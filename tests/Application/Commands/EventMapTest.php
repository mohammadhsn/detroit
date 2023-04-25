<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\EventMap;
use Detroit\Tests\Domain\Event\DummyEvent;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class EventMapTest extends TestCase
{
    public function test_validation() 
    {
        $map = new EventMap(DummyEvent::class, [DummyEventHandler::class]);
        $this->assertInstanceOf(EventMap::class, $map);
        $this->expectException(InvalidArgumentException::class);
        new EventMap(DummyEvent::class, [DoSomethingElse::class]);
        new EventMap(DoSomething::class, [DoSomethingHandler::class]);
    }
}
