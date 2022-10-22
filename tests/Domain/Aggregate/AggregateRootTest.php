<?php

namespace Detroit\Tests\Domain\Aggregate;

use Detroit\Tests\Domain\Event\DummyEvent;
use PHPUnit\Framework\TestCase;

class AggregateRootTest extends TestCase
{
    public function test_create_aggregate_root() 
    {
        $aggregate = new DummyAggregateRoot;
        $this->assertInstanceOf(DummyAggregateRoot::class, $aggregate);
    }

    public function test_record_event()
    {
        $aggregate = new DummyAggregateRoot;
        $aggregate->doSomething();
        $this->assertInstanceOf(DummyEvent::class, $aggregate->pullRecordedEvents()[0]);
    }
}
