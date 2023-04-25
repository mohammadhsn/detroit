<?php

declare(strict_types=1);

namespace Detroit\Tests\Application\Commands;

use Detroit\Core\Application\Commands\CommandMap;
use Detroit\Core\Application\Commands\CommandRepository;
use Detroit\Tests\Domain\DummyRepository;
use PHPUnit\Framework\TestCase;

class CommandRepositoryTest extends TestCase
{
    private CommandRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CommandRepository([
            new CommandMap(DoSomething::class, DoSomethingHandler::class, DummyRepository::class)
        ]);
    }

    public function test_exists()
    {
        $this->assertTrue($this->repository->exists(new DoSomething));
    }

    public function test_map_for()
    {
        $this->assertInstanceOf(CommandMap::class, $map = $this->repository->mapFor(new DoSomething));
        $this->assertEquals(DoSomething::class, $map->command);
        $this->assertEquals(DoSomethingHandler::class, $map->handler);
        $this->assertEquals(DummyRepository::class, $map->repo);
    }

    public function test_handler_class_for()
    {
        $this->assertEquals(DoSomethingHandler::class, $this->repository->handlerClassFor(new DoSomething));
    }

    public function test_repo_class_for()
    {
        $this->assertEquals(DummyRepository::class, $this->repository->repoClassFor(new DoSomething));
    }
}
