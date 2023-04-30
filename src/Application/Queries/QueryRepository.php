<?php

declare(strict_types=1);

namespace Detroit\Core\Application\Queries;

class QueryRepository
{
    /** @var QueryMap[] */
    private array $queries = [];

    /** @param QueryMap[] $queries */
    public static function fromQueries(array $queries): self
    {
        $repo = new self();

        foreach ($queries as $map) {
            $repo->register($map);
        }

        return $repo;
    }

    public static function fromMap(QueryMap $map): self
    {
        return (new static())->register($map);
    }

    public function register(QueryMap $map): self
    {
        $this->queries[$map->query] = $map;
    }

    public function all(): array
    {
        return array_keys($this->queries);
    }

    public function exists(Query $query): bool
    {
        return \in_array(\get_class($query), $this->queries, true);
    }

    public function mapFor(Query $query): QueryMap
    {
        if (!$this->exists($query)) {
            throw QueryDoesNotExist::from($query);
        }

        return $this->queries[\get_class($query)];
    }

    public function handlerClassFor(Query $query): string
    {
        return $this->mapFor($query)->handler;
    }
}
