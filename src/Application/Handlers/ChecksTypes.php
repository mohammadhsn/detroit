<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Handlers;

use InvalidArgumentException;
use ReflectionClass;

trait ChecksTypes
{
    protected function mustImplement(string $class, string $interface): void
    {
        $ref = new ReflectionClass($class);

        if (!$ref->implementsInterface($interface)) {
            throw new InvalidArgumentException(sprintf('Class %s must implement %s', $class, $interface));
        }
    }

    protected function mustExtend(string $class, string $parent): void
    {
        $ref = new ReflectionClass($class);

        if (!$ref->isSubclassOf($parent)) {
            throw new InvalidArgumentException(sprintf('Class %s must extend %s', $class, $parent));
        }
    }
}
