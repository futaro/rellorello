<?php

namespace RelloRello\Api\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class AbstractRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
abstract class AbstractRequest extends FormRequest
{
    /**
     * エラー時の処理
     *
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        $response_data = [
            "message" => $errors
        ];

        $response = new JsonResponse();
        return $response
            ->setStatusCode(500)
            ->header('Access-Control-Allow-Origin', '*')
            ->setData($response_data);
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
}