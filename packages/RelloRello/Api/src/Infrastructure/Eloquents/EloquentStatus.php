<?php

namespace RelloRello\Api\Infrastructure\Eloquents;

use RelloRello\Api\Domain\Models\Status;
use RelloRello\Api\Domain\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class EloquentStatus
 *
 * @package RelloRello\Api\Infrastructure\Eloquents
 * @property int project_id
 * @property string subject
 * @property int order_num
 */
class EloquentStatus extends AppEloquent implements Domainable
{
    /**
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'subject', 'order_num'
    ];

    /**
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(EloquentTask::class, 'status_id', 'id');
    }

    public function toDomain(): Status
    {
        return new Status(
            $this->id,
            (int)$this->project_id,
            $this->subject,
            (int)$this->order_num
        );
    }
}