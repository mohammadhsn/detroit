<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

use Detroit\Core\Domain\Event\DomainEvent;

class EventRepository
{
    private array $events = [];

    /**
     * @param $events EventMap[]
     */
    public static function fromEvents(array $events): self
    {
        $repo = new static();

        foreach ($events as $event) {
            $repo->register($event);
        }

        return $repo;
    }

    public static function fromMap(EventMap $map): self
    {
        return (new static())->register($map);
    }

    public function register(EventMap $map): self
    {
        if ($this->classExists($map->event)) {
            $this->events[$map->event] = array_unique(array_merge($this->events[$map->event], $map->handlers));
        } else {
            $this->events[$map->event] = $map->handlers;
        }

        return $this;
    }

    public function all(): array
    {
        return array_keys($this->events);
    }

    public function events(): array
    {
        return $this->events;
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
