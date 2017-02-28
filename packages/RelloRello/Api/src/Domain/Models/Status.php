<?php

namespace RelloRello\Api\Domain\Models;

/**
 * Class Status
 *
 * @package RelloRello\Api\Domain\Models
 *
 * @method int|null getId()
 * @method int getProjectId()
 * @method string getSubject()
 * @method int getOrderNum()
 */
class Status extends AbstractModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $project_id;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var int
     */
    private $order_num;

    /**
     * Status constructor.
     *
     * @param int|null $id
     * @param int $project_id
     * @param string $subject
     * @param int $order_num
     */
    public function __construct(
        int $id = null,
        int $project_id,
        string $subject,
        int $order_num
    )
    {
        $this->id = $id ?? null;
        $this->project_id = $project_id;
        $this->subject = $subject;
        $this->order_num = $order_num;
    }
}