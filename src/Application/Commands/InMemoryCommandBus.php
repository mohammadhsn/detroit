<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Aggregate\Repository;
use Detroit\Core\Domain\Event\DomainEvent;
use Psr\Container\ContainerInterface;


class InMemoryCommandBus implements CommandBus
{
    public function __construct(
        private readonly CommandRepository $commands,
        private readonly EventRepository $events,
        private readonly ContainerInterface $container,
    )
    {
    }

    public function handle(Command|DomainEvent $message): ?string
    {
        if ($message instanceof Command) {
            return $this->handleCommand($message);
        } else {
            $this->handleEvent($message);
            return null;
        }
    }

    private function handleCommand(Command $command): ?string
    {
        return $this->resolveCommandHandler($command)
            ->handle($command, $this->resolveRepoFor($command));
    }

    private function handleEvent(DomainEvent $event): void
    {
        foreach ($this->events->handlersFor($event) as $handler) {
            (new $handler)->handle($event);
        }
    }

    private function resolveCommandHandler(Command $command): CommandHandler
    {
        return $this->container->get(
            $this->commands->handlerClassFor($command)
        );
    }

    private function resolveRepoFor(Command $command): Repository
    {
        return $this->container->get(
            $this->commands->repoClassFor($command)
        );
    }
}
