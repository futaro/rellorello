<?php

namespace RelloRello\Api\Domain\Models;

use Carbon\Carbon;

/**
 * Class Task
 *
 * @package RelloRello\Api\Domain\Models
 *
 * @method int|null getId()
 * @method string getSubject()
 * @method null|string getDescription()
 * @method int getCreatedUserId()
 * @method int|null getAssigneeUserId()
 * @method int getStatusId()
 * @method int getOrderNum()
 * @method Carbon|null getCreated()
 */
class Task extends AbstractModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $created_user_id;

    /**
     * @var int
     */
    private $assignee_user_id;

    /**
     * @var int
     */
    private $status_id;

    /**
     * @var int
     */
    private $order_num;

    /**
     * @var Carbon
     */
    private $created;

    /**
     * Task constructor.
     *
     * @param int|null $id
     * @param string $subject
     * @param string $description
     * @param int $created_user_id
     * @param int $assignee_user_id
     * @param int $status_id
     * @param int $order_num
     * @param Carbon $created
     */
    public function __construct(
        int $id = null,
        string $subject,
        string $description = null,
        int $created_user_id,
        int $assignee_user_id = null,
        int $status_id,
        int $order_num,
        Carbon $created = null
    )
    {
        $this->id = $id ?? null;
        $this->subject = $subject;
        $this->description = $description ?? null;
        $this->created_user_id = $created_user_id;
        $this->assignee_user_id = $assignee_user_id ?? null;
        $this->status_id = $status_id;
        $this->order_num = $order_num;
        $this->created = $created ?? null;
    }
}