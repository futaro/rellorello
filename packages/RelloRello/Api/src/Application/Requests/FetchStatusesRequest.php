<?php

namespace RelloRello\Api\Application\Requests;

/**
 * Class FetchStatusesRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
class FetchStatusesRequest extends AbstractRequest
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
        return $this->query('project_id', 0);
    }
}