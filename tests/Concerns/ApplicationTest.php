<?php

declare(strict_types=1);

namespace Detroit\Tests\Concerns;

use Detroit\Core\Concerns\Application;
use Detroit\Core\Concerns\BoundedContext\Context;
use Detroit\Tests\Application\Commands\DoSomething;
use Detroit\Tests\Application\Commands\DoSomethingHandler;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    protected Application $app;

    protected function setUp(): void
    {
        $this->app = new Application('my-app', [
            new Context('orders', 'src/Order', [
                DoSomething::class => DoSomethingHandler::class,
            ]),
        ]);
    }

    public function test_command_bus()
    {
        $this->assertNull($this->app->commandBus()->handle(new DoSomething()));
    }
}
