<?php

namespace Detroit\Tests\Domain\Aggregate;

use PHPUnit\Framework\TestCase;

class AggregateRootTest extends TestCase
{
    public function test_create_aggregate_root() 
    {
        $aggregate = new DummyAggregateRoot;
        $this->assertInstanceOf(DummyAggregateRoot::class, $aggregate);
    }
}
