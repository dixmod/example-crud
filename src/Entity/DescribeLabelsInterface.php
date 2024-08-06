<?php

namespace App\Entity;

/**
 * Перевод полей и заголовков сущности
 */
interface DescribeLabelsInterface
{
    /**
     * @return array<string, string>
     */
    public static function labels(): array;
}
