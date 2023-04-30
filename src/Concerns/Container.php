<?php

declare(strict_types=1);

namespace Detroit\Core\Concerns;

use Detroit\Core\Application\Bus\InMemoryCommandBus;
use Detroit\Tests\Application\Handlers\Seed\L1EventHandler;
use Detroit\Tests\Application\Handlers\Seed\L2EventHandler;
use Exception;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    public function get(string $id)
    {
        if (method_exists($this, $method = 'resolve'.$this->determineClassName($id))) {
            return \call_user_func([$this, $method]);
        }

        if (class_exists($id)) {
            return new $id();
        }

        throw new Exception("class {$id} does not exist");
    }

    public function has(string $id): bool
    {
        return class_exists($id);
    }

    private function determineClassName(string $namespace): string
    {
        $arr = explode('\\', $namespace);

        return $arr[\count($arr) - 1];
    }

    private function resolveL1EventHandler(): L1EventHandler
    {
        return new L1EventHandler(InMemoryCommandBus::getInstance());
    }

    private function resolveL2EventHandler(): L2EventHandler
    {
        return new L2EventHandler(InMemoryCommandBus::getInstance());
    }
}
