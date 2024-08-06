<?php

declare(strict_types=1);

namespace App\Traits;

use App\Support\Json\JsonSerializeHelper;

/**
 * Trait JsonSerializeTrait
 */
trait JsonSerializeTraitRecurse
{
    /**
     * @return array<string, mixed>
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function jsonSerialize(): array
    {
        return JsonSerializeHelper::jsonSerializeRecursive(get_object_vars($this));
    }
}
