<?php

namespace RelloRello\Api\Application\Requests;

/**
 * Class StoreStatusRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
class StoreStatusRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required',
            'project_id' => 'required|numeric'
        ];
    }

    public function getSubject()
    {
        return $this->get('subject', null);
    }

    public function getProjectId()
    {
        return $this->get('project_id', null);
    }
}