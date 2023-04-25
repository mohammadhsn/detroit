<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Event\DomainEvent;
use Detroit\Core\Application\Commands\EventRepository;

class InMemoryCommandBus implements CommandBus
{
    public function __construct(
        private readonly CommandRepository $commands,
        private readonly EventRepository $events,
    )
    {
    }

    public function handle(Command|DomainEvent $message): ?string
    {
        if ($message instanceof Command) {
            $this->handleCommand($message);
        } elseif ($message instanceof DomainEvent) {
            $this->handleEvent($message);
        }
    }

    private function handleCommand(Command $command): ?string
    {
        $handler = $this->commands->handlerClassFor($command);

        return (new $handler)->handle($command);
    }

    private function handleEvent(DomainEvent $event): void
    {
        foreach ($this->events->handlersFor($event) as $handler) {
            (new $handler)->handle($event);
        }
    }
}
