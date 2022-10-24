<?php

declare(strict_types=1);

namespace Detroit\Core\Concerns;

use Detroit\Core\Concerns\BoundedContext\Context;

class ApplicationFactory
{
    private array $contexts = [];

    private string $name = 'app';

    public static function withName(string $name): self
    {
        $factory = new self();
        $factory->name = $name;

        return $factory;
    }

    public static function fromContext(Context ...$context): self
    {
        $factory = new self();
        $factory->addContext(...$context);

        return $factory;
    }

    public function addContext(Context ...$context): self
    {
        foreach ($context as $item) {
            $this->contexts[] = $item;
        }

        return $this;
    }

    public function create(): Application
    {
        return new Application($this->name, $this->contexts);
    }
}
