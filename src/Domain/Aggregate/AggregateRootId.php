<?php

declare(strict_types=1);

namespace Detroit\Core\Domain\Aggregate;

class AggregateRootId
{
    public function __construct(public readonly string $value)
    {
    }

    public static function fromValue(string $value): self
    {
        return new static($value);
    }

    public function is(self $other): bool
    {
        return $this->value === $other->value;
    }
}
