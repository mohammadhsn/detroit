<?php

declare(strict_types=1);

namespace Detroit\Core;

use Detroit\Core\Application\Bus\CommandBus;
use Detroit\Core\Application\Bus\InMemoryCommandBus;
use Detroit\Core\Application\Bus\Transaction;
use Detroit\Core\Application\Command\CommandMap;
use Detroit\Core\Application\Command\CommandRepository;
use Detroit\Core\Application\Handlers\EventMap;
use Detroit\Core\Application\Handlers\EventRepository;
use Psr\Container\ContainerInterface;

class App
{
    private CommandRepository $commands;

    private EventRepository $events;

    private ContainerInterface $container;

    private ?Transaction $txn = null;

    private static ?CommandBus $bus = null;

    public function commandBus(): CommandBus
    {
        if (self::$bus !== null) {
            return self::$bus;
        }

        self::$bus = new InMemoryCommandBus(
            $this->commands, $this->events, $this->container, $this->txn
        );

        return $this->commandBus();
    }

    public function registerCommand(CommandMap $map): self
    {
        $this->commands->register($map);

        return $this;
    }

    public function registerEvent(EventMap $map): self
    {
        $this->events->register($map);

        return $this;
    }

    public function setCommandRepo(CommandRepository $repository): self
    {
        $this->commands = $repository;

        return $this;
    }

    public function setEventRepo(EventRepository $repository): self
    {
        $this->events = $repository;

        return $this;
    }

    public function setContainer(ContainerInterface $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function setTxn(?Transaction $txn): self
    {
        $this->txn = $txn;

        return $this;
    }
}
