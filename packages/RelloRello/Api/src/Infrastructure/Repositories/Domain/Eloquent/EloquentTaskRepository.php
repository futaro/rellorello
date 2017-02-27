<?php

namespace RelloRello\Api\Infrastructure\Repositories\Domain\Eloquent;

use RelloRello\Api\Domain\Models\Task;
use RelloRello\Api\Domain\Repositories\TaskRepository;
use RelloRello\Api\Infrastructure\Eloquents\EloquentTask;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EloquentTaskRepository
 *
 * @package RelloRello\Api\Infrastructure\Repositories\Domain\Eloquent
 */
class EloquentTaskRepository implements TaskRepository
{
    /**
     * @var EloquentTask
     */
    private $eloquent;

    /**
     * EloquentTaskRepository constructor.
     *
     * @param EloquentTask $eloquent
     */
    public function __construct(EloquentTask $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param array $p
     * @return Task[]|array
     */
    public function find(array $p)
    {
        $collections = $this->_find($p);

        $tasks = [];
        foreach ($collections as $task) {
            $tasks[] = $task->toDomain();
        }

        return $tasks;
    }

    public function findAsArray(array $p)
    {
        $collections = $this->_find($p);

        $tasks = [];
        foreach ($collections as $task) {
            $tasks[] = $task->toArray();
        }

        return $tasks;
    }

    /**
     * @param array $p
     * @return EloquentTask[]
     */
    private function _find(array $p)
    {
        $query = $this->eloquent->joinStatus()
                                ->with('status')
                                ->newQuery();

        if (isset($p['where'])) {
            $query->where($p['where']);
        }

        if (isset($p['orderBy'])) {
            $query->orderBy($p['orderBy'][0], $p['orderBy'][1]);
        }

        if (isset($p['limit'])) {
            $query->take($p['limit']);
        }

        /** @var EloquentTask[] $collections */
        $collections = $query->get();

        return $collections;
    }
}
