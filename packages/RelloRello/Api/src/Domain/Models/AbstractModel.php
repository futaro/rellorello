<?php

namespace RelloRello\Api\Domain\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\JsonEncodingException;

/**
 * Class AbstractModel
 *
 * @package RelloRello\Api\Domain\Models
 */
abstract class AbstractModel
{
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    public function toArray()
    {
        $arr = [];
        $ref = new \ReflectionClass(static::class);

        foreach ($ref->getProperties() as $prop) {
            $prop->setAccessible(true);
            $value = $prop->getValue($this);

            if ($value instanceof Carbon) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $arr[$prop->getName()] = $value;
        }

        return $arr;
    }
}