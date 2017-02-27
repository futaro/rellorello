<?php

namespace RelloRello\Api\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Response;

/**
 * Class AbstractRequest
 *
 * @package RelloRello\Api\Application\Requests
 */
abstract class AbstractRequest extends FormRequest
{
    //エラー時の処理
    public function response(array $errors)
    {
        $headers = [
            'Access-Control-Allow-Origin' => ' *',
        ];

        $response["message"] = $errors;

        return Response::json($response, 500, $headers);
    }
}