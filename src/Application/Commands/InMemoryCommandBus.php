<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

class InMemoryCommandBus implements CommandBus
{
    public function __construct(private readonly CommandRepository $repository)
    {
    }

    public function handle(Command $command): ?string
    {
        $handler = new ($this->repository->handlerClassFor($command));

        return $handler->handle($command);
    }
}
