<?php

namespace RelloRello\Api\Infrastructure\Repositories\Domain\Eloquent;

use RelloRello\Api\Domain\Exceptions\NotFoundException;
use RelloRello\Api\Domain\Models\Status;
use RelloRello\Api\Domain\Repositories\StatusRepository;
use RelloRello\Api\Infrastructure\Eloquents\EloquentStatus;

/**
 * Class EloquentStatusRepository
 *
 * @package RelloRello\Api\Infrastructure\Repositories\Domain\Eloquent
 */
class EloquentStatusRepository implements StatusRepository
{
    /**
     * @var EloquentStatus
     */
    private $eloquent;

    /**
     * EloquentStatusRepository constructor.
     *
     * @param EloquentStatus $eloquent
     */
    public function __construct(EloquentStatus $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param int $id
     * @return Status
     * @throws NotFoundException
     */
    public function findOne(int $id): Status
    {
        /** @var EloquentStatus $task */
        $task = $this->eloquent->newQuery()
                               ->where('id', $id)
                               ->first();

        if ($task) {
            return $task->toDomain();
        } else {
            throw new NotFoundException('status');
        }
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

    /**
     * @param array $p
     * @return array
     */
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


    /**
     * @param int $project_id
     * @return int
     */
    public function getMaxOrderNum(int $project_id): int
    {
        $status_orders = $this->eloquent->newQuery()
                                        ->where('project_id', $project_id)
                                        ->orderBy('order_num', 'DESC')
                                        ->pluck('order_num')
                                        ->toArray();

        if (!is_array($status_orders) || count($status_orders) <= 0) {
            return 0;
        } else {
            return $status_orders[0];
        }
    }

    /**
     * @param Status $status
     * @return Status
     * @throws \Exception
     */
    public function save(Status $status): Status
    {
        $eloquent = ($status->getId())
            ? EloquentStatus::find($status->getId())
            : new EloquentStatus();

        $eloquent->fill($status->toArray());

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
        EloquentStatus::destroy($id);
    }

    /**
     * @param array $sort_statuses
     * @return bool
     */
    public function updateOrderNum(array $sort_statuses): bool
    {
        foreach ($sort_statuses as $id => $order_num ) {
            EloquentStatus::where('id', $id)
                ->update(['order_num' => $order_num]);
        }

        return true;
    }
}
