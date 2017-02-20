<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @package App\Models
 * @property string subject
 * @property string description
 * @property int created_user_id
 * @property int assignee_user_id
 * @property int status_id
 * @property int order_num
 */
class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'description', 'created_user_id', 'assignee_user_id', 'status_code', 'order_num'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
