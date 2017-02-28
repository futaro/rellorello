<?php

namespace RelloRello\Api\Infrastructure\Repositories\Domain\Eloquent;

use RelloRello\Api\Domain\Exceptions\NotFoundException;
use RelloRello\Api\Domain\Models\Task;
use RelloRello\Api\Domain\Repositories\TaskRepository;
use RelloRello\Api\Infrastructure\Eloquents\EloquentTask;

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
     * @param int $id
     * @return Task
     * @throws NotFoundException
     */
    public function findOne(int $id): Task
    {
        /** @var EloquentTask $task */
        $task = $this->eloquent->where('id', $id)
                               ->first();

        if ($task) {
            return $task->toDomain();
        } else {
            throw new NotFoundException('task');
        }
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

    /**
     * @param int $status_id
     * @return int
     */
    public function getMaxOrderNum(int $status_id): int
    {
        $task_orders = $this->eloquent->where('status_id', $status_id)
                                      ->orderBy('order_num', 'DESC')
                                      ->pluck('order_num')
                                      ->toArray();

        if (!is_array($task_orders) || count($task_orders) <= 0) {
            return 0;
        } else {
            return $task_orders[0];
        }
    }

    /**
     * @param Task $task
     * @return Task
     * @throws \Exception
     */
    public function save(Task $task): Task
    {
        $eloquent = ($task->getId())
            ? EloquentTask::find($task->getId())
            : new EloquentTask();

        $eloquent->fill($task->toArray());

        if ($eloquent->save()) {
            return $this->findOne($eloquent->id);
        } else {
            throw new \Exception('save failed');
        }
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        EloquentTask::destroy($id);
    }
}
