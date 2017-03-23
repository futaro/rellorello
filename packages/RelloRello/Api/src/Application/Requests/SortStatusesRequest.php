<?php

namespace RelloRello\Api\Application\Requests;

/**
 * Class SortStatusesRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
class SortStatusesRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'statuses' => 'required'
        ];
    }
}