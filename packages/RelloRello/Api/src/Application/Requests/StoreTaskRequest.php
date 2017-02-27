<?php

namespace RelloRello\Api\Application\Requests;

/**
 * Class AbstractStoreTaskRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
class StoreTaskRequest extends AbstractRequest
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
            'created_user_id' => 'required|numeric',
            'assignee_user_id' => 'numeric|nullable',
            'status_id' => 'required|numeric'
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

    public function getSubject()
    {
        return $this->get('subject', null);
    }

    public function getDescription()
    {
        return $this->get('description', null);
    }

    public function getCreatedUserId()
    {
        return $this->get('created_user_id', null);
    }

    public function getAssigneeUserId()
    {
        return $this->get('assignee_user_id', null);
    }

    public function getStatusId()
    {
        return $this->get('status_id', null);
    }
}