<?php

use Detroit\Core\Concerns\Application;
use Detroit\Core\Concerns\BoundedContext\Context;
use Detroit\Tests\Application\Commands\DoSomething;
use Detroit\Tests\Application\Commands\DoSomethingElse;


$app = new Application('my-app', [
    new Context('orders', 'src/Order', [
        DoSomething::class => DoSomethingElse::class
    ]),
]);

$app->commandBus()->handle(new DoSomething);
