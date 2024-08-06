<?php

declare(strict_types=1);

namespace App\Support\Json;

use JsonSerializable;

/**
 * Class JsonSerializeHelper
 */
class JsonSerializeHelper
{
    /**
     * @param array<mixed> $data
     *
     * @return array<mixed>
     */
    public static function jsonSerializeRecursive(array $data)
    {
        return array_map(static function ($value) {
            if ($value instanceof JsonSerializable) {
                return $value->jsonSerialize();
            }

            if (is_array($value)) {
                return self::jsonSerializeRecursive($value);
            }

            return $value;
        }, $data);
    }
}
