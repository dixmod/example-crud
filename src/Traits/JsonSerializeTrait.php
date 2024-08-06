<?php

declare(strict_types=1);

namespace App\Traits;

use App\Interfaces\EntityResponseInterface;

/**
 * Trait JsonSerializeTrait
 */
trait JsonSerializeTrait
{
    /**
     * @return array<string, mixed>
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function jsonSerialize(): array
    {
        $res = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($value instanceof EntityResponseInterface) {
                continue;
            }
            $res[$key] = $value;
        }
        return $res;
    }
}
