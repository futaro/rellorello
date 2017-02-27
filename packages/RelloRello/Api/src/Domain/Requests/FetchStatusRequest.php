<?php

namespace RelloRello\Api\Domain\Requests;

use RelloRello\Api\Application\Requests\AbstractFetchStatusRequest;

/**
 * Class FetchStatusRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
class FetchStatusRequest extends AbstractFetchStatusRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|numeric'
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