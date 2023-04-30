<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

use Detroit\Core\Domain\Event\DomainEvent;
use Detroit\Core\Domain\Repository\Repository;
use Psr\Container\ContainerInterface;

class InMemoryCommandBus implements CommandBus
{
    /** @var DomainEvent[] */
    public array $records = [];
    /** @var DomainEvent[] */
    public array $proceed = [];

    public array $results = [];

    private static ?self $instance = null;

    public function __construct(
        private readonly CommandRepository $commands,
        private readonly EventRepository $events,
        private readonly ContainerInterface $container,
    ) {
        self::$instance = $this;
    }

    public static function getInstance(...$args): self
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        self::$instance = new self(...$args);

        return self::$instance;
    }

    public function handle(Command|DomainEvent $message): ?string
    {
        if ($message instanceof Command) {
            return $this->handleCommand($message);
        }

        $this->handleEvent($message);

        return null;
    }

    private function handleCommand(Command $command): ?string
    {
        $result = $this->resolveCommandHandler($command)
            ->handle($command, $repo = $this->resolveRepoFor($command));

        if ($result) {
            $this->results[] = $result;
        }

        foreach ($repo->seen() as $aggregateRoot) {
            $this->records = array_merge($this->records, $aggregateRoot->pullRecordedEvents());
        }

        while ($this->records) {
            $this->handleEvent($event = array_pop($this->records));
            $this->proceed[] = $event;
        }

        return null;
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
