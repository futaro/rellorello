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
    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * @return array
     */
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

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws \Exception
     */
    function __call($method, $arguments)
    {
        if (preg_match('/^get(.+)$/', $method, $m) === 0) {
            throw new \Exception('method not found');
        }

        $name = snake_case($m[1]);

        $ref = new \ReflectionClass(static::class);

        if (!$ref->hasProperty($name)) {
            throw new \Exception('method not found');
        }

        $prop = $ref->getProperty($name);

        if (!$prop->isPublic()) {
            $prop->setAccessible(true);
        }

        return $prop->getValue($this);
    }
}