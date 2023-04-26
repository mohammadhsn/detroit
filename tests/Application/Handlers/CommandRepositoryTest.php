<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Handlers;

use Detroit\Core\Application\Handlers\CommandMap;
use Detroit\Core\Application\Handlers\CommandRepository;
use Detroit\Tests\Domain\Repository\DummyRepository;
use PHPUnit\Framework\TestCase;

class CommandRepositoryTest extends TestCase
{
    private CommandRepository $repository;

    protected function setUp(): void
    {
        $this->repository = CommandRepository::fromMap(
            new CommandMap(DoSomething::class, DoSomethingHandler::class, DummyRepository::class)
        );
    }

    public function test_exists()
    {
        $this->assertTrue($this->repository->exists(new DoSomething('hi')));
    }

    public function test_map_for()
    {
        $this->assertInstanceOf(CommandMap::class, $map = $this->repository->mapFor(new DoSomething('hi')));
        $this->assertSame(DoSomething::class, $map->command);
        $this->assertSame(DoSomethingHandler::class, $map->handler);
        $this->assertSame(DummyRepository::class, $map->repo);
    }

    public function test_handler_class_for()
    {
        $this->assertSame(DoSomethingHandler::class, $this->repository->handlerClassFor(new DoSomething('hi')));
    }

    public function test_repo_class_for()
    {
        $this->assertSame(DummyRepository::class, $this->repository->repoClassFor(new DoSomething('hi')));
    }

    public function test_array_factory()
    {
        $repo = CommandRepository::fromCommands([
            new CommandMap(DoSomething::class, DoSomethingHandler::class, DummyRepository::class),
            new CommandMap(DoSomethingElse::class, DoSomethingHandler::class, DummyRepository::class),
        ]);

        $this->assertCount(2, $repo->all());
    }
}
