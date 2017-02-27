<?php

namespace RelloRello\Api\Infrastructure\Repositories\Domain\Eloquent;

use RelloRello\Api\Domain\Models\Status;
use RelloRello\Api\Domain\Repositories\StatusRepository;
use RelloRello\Api\Infrastructure\Eloquents\EloquentStatus;

class EloquentStatusRepository implements StatusRepository
{
    private $eloquent;

    public function __construct(EloquentStatus $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param array $p
     * @return Status[]|array
     */
    public function find(array $p)
    {
        $collections = $this->_find($p);

        $statuses = [];
        foreach ($collections as $status) {
            $statuses[] = $status->toDomain();
        }

        return $statuses;
    }

    public function findAsArray(array $p)
    {
        $collections = $this->_find($p);

        $statuses = [];
        foreach ($collections as $status) {
            $statuses[] = $status->toArray();
        }

        return $statuses;
    }

    /**
     * @param array $p
     * @return EloquentStatus[]
     */
    private function _find(array $p)
    {
        $query = $this->eloquent->with('tasks')
                                ->newQuery();

        if (isset($p['where'])) {
            $query->where($p['where']);
        }

        if (isset($p['orderBy'])) {
            $query->orderBy($p['orderBy'][0], $p['orderBy'][1]);
        }

        /** @var EloquentStatus[] $collections */
        $collections = $query->get();

        return $collections;
    }

}
