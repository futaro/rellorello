<?php

namespace RelloRello\Api\Infrastructure\Eloquents;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use RelloRello\Api\Domain\Models\Task;

/**
 * Class EloquentTask
 *
 * @package RelloRello\Api\Infrastructure\Eloquents
 * @property int id
 * @property string subject
 * @property string description
 * @property int created_user_id
 * @property int assignee_user_id
 * @property int status_id
 * @property int order_num
 * @property string created
 */
class EloquentTask extends AppEloquent implements Domainable
{
    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'description', 'created_user_id', 'assignee_user_id', 'status_id', 'order_num', 'created'
    ];

    /**
     * @return Task
     */
    public function toDomain(): Task
    {
        return new Task(
            $this->id,
            $this->subject,
            $this->description,
            (int)$this->created_user_id,
            (int)$this->assignee_user_id,
            (int)$this->status_id,
            (int)$this->order_num,
            new Carbon($this->created)
        );
    }

    /**
     * @return HasOne
     */
    public function status()
    {
        return $this->hasOne(EloquentStatus::class, 'id');
    }

    /**
     * @return EloquentTask
     */
    public function joinStatus()
    {
        $status_table = with(new EloquentStatus())->getTable();
        return $this->leftJoin(
            $status_table,
            "{$status_table}.id", '=', "{$this->table}.status_id"
        );
    }
}