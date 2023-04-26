<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Aggregate\Repository;
use Detroit\Core\Domain\Event\DomainEvent;
use Psr\Container\ContainerInterface;


class InMemoryCommandBus implements CommandBus
{
    /** @var $records DomainEvent[] */
    public array $records = [];

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
        $result = $this->resolveCommandHandler($command)
            ->handle($command, $repo = $this->resolveRepoFor($command));

        foreach ($repo->seen() as $aggregateRoot) {
            $this->records = array_merge($this->records, $aggregateRoot->pullRecordedEvents());
        }

        return $result;
    }

    private function handleEvent(DomainEvent $event): void
    {
        foreach ($this->resolveEventHandlers($event) as $handler) {
            $handler->handle($event);
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

    /** @return EventHandler[] */
    private function resolveEventHandlers(DomainEvent $event): array
    {
        return array_map(
            fn (string $handlerClass) => $this->container->get($handlerClass),
            $this->events->handlersFor($event)
        );
    }
}
