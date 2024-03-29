<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Bus;

use Detroit\Core\Application\Command\Command;
use Detroit\Core\Application\Command\CommandRepository;
use Detroit\Core\Application\Command\CommandResult;
use Detroit\Core\Application\Handlers\AfterCommit;
use Detroit\Core\Application\Handlers\CommandHandler;
use Detroit\Core\Application\Handlers\EventHandler;
use Detroit\Core\Application\Handlers\EventMap;
use Detroit\Core\Application\Handlers\EventRepository;
use Detroit\Core\Domain\Event\DomainEvent;
use Detroit\Core\Domain\Repository\Repository;
use Psr\Container\ContainerInterface;

class InMemoryCommandBus implements CommandBus
{
    /** @var DomainEvent[] */
    public array $records = [];
    /** @var DomainEvent[] */
    public array $proceed = [];
    /** @var CommandResult[] */
    public array $results = [];

    private static EventRepository $afterCommits;

    /** @var DomainEvent[] */
    public array $afterCommitEvents = [];

    private static ?self $instance = null;

    public function __construct(
        private readonly CommandRepository $commands,
        private readonly EventRepository $events,
        private readonly ContainerInterface $container,
        public readonly ?Transaction $txn = null)
    {
        self::$instance = $this;
        self::$afterCommits = new EventRepository();
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
        $this->start();

        if ($message instanceof Command) {
            $this->handleCommand($message);
        } else {
            $this->handleEvent($message);
        }

        $this->commit();

        //        foreach (self::$afterCommits->events() as $event => $handlers) {
        //            foreach ($handlers as $handler) {
        //                $handler->handle($this->afterCommitEvents[$event]);
        //            }
        //        }

        return null;
    }

    private function handleCommand(Command $command): ?string
    {
        $result = $this->resolveCommandHandler($command)
            ->handle($command, $repo = $this->resolveRepoFor($command));

        if ($result) {
            $this->results[] = new CommandResult($command, $result);
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
            if ($handler instanceof AfterCommit) {
                self::$afterCommits->register(
                    new EventMap(\get_class($event), [$handler])
                );
                $this->afterCommitEvents[\get_class($event)] = $event;
                continue;
            }

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

    private function start(): void
    {
        if (!$this->txn || $this->txn->hasBeenStarted()) {
            return;
        }

        $this->txn->start();
    }

    private function commit()
    {
        if (!$this->txn || $this->txn->hasBeenCommitted()) {
            return;
        }

        $this->txn->commit();
    }
}
