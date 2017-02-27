<?php

namespace RelloRello\Api\Domain\Models;

/**
 * Class Task
 *
 * @package RelloRello\Api\Domain\Models
 */
class Task
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
     * Task constructor.
     *
     * @param int|null $id
     * @param string $subject
     * @param string $description
     * @param int $created_user_id
     * @param int $assignee_user_id
     * @param int $status_id
     * @param int $order_num
     */
    public function __construct(
        int $id = null,
        string $subject,
        string $description = null,
        int $created_user_id,
        int $assignee_user_id = null,
        int $status_id,
        int $order_num
    )
    {
        $this->id = $id ?? null;
        $this->subject = $subject;
        $this->description = $description ?? null;
        $this->created_user_id = $created_user_id;
        $this->assignee_user_id = $assignee_user_id ?? null;
        $this->status_id = $status_id;
        $this->order_num = $order_num;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreatedUserId()
    {
        return $this->created_user_id;
    }

    public function getAssigneeUserId()
    {
        return $this->assignee_user_id;
    }

    public function getStatusId()
    {
        return $this->status_id;
    }

    public function getOrderNum()
    {
        return $this->order_num;
    }

    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }
}