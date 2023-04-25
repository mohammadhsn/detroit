<?php

declare(strict_types=1);

namespace Detroit\Core\Concerns\App;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    public function get(string $id)
    {
        if (class_exists($id)) {
            return new $id;
        }

        throw new NotFoundExceptionInterface;
    }

    public function has(string $id): bool
    {
        return class_exists($id);
    }
}
