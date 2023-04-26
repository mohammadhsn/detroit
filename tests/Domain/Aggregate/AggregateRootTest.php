<?php

declare(strict_types=1);

namespace Detroit\Tests\Domain\Aggregate;

use Detroit\Core\Domain\Aggregate\AggregateRootId;
use Detroit\Tests\Domain\Event\SomethingHappened;
use PHPUnit\Framework\TestCase;

class AggregateRootTest extends TestCase
{
    public function test_create_aggregate_root()
    {
        $aggregate = new DummyAggregateRoot(new AggregateRootId('foo'), 'bar');
        $this->assertInstanceOf(DummyAggregateRoot::class, $aggregate);
    }

    public function test_record_event()
    {
        $aggregate = DummyAggregateRoot::withRecorded(new AggregateRootId('foo'), 'bar');
        $this->assertInstanceOf(SomethingHappened::class, $aggregate->pullRecordedEvents()[0]);
    }
}
