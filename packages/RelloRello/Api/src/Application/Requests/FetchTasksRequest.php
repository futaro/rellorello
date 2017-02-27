<?php

namespace RelloRello\Api\Application\Requests;

/**
 * Class FetchTasksRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
class FetchTasksRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|numeric',
            'status_id' => 'numeric',
            'limit' => 'numeric'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return (int)$this->query('project_id', 0);
    }

    /**
     * @return int|null
     */
    public function getStatusId()
    {
        return $this->query('status_id', null);
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->query('limit', 30);
    }
}