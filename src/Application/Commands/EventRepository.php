<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Commands;

use Detroit\Core\Domain\Event\DomainEvent;

class EventRepository
{
    private array $events;

    /**
     * @param array<string: array<string>>
     */
    public function __construct(array $events)
    {
        foreach ($events as $event => $handlers) {
            $this->register($event, $handlers);
        }
    }

    public function register(string $eventClass, array $handlerClasses): self
    {
        if ($this->classExists($eventClass)) {
            $this->events[$eventClass] = array_merge($this->events[$eventClass], $handlerClasses);
        } else {
            $this->events[$eventClass] = $handlerClasses;
        }

        return $this;
    }

    public function all(): array
    {
        return array_keys($this->events);
    }

    public function classExists(string $event): bool
    {
        return \array_key_exists($event, $this->events);
    }

    public function exists(DomainEvent $event): bool
    {
        return \array_key_exists(\get_class($event), $this->events);
    }

    public function handlersFor(DomainEvent $event): array
    {
        if (!$this->exists($event)) {
            throw EventDoesNotExist::from($event);
        }

        return $this->events[\get_class($event)];
    }
}
