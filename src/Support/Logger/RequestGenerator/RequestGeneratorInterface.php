<?php

namespace App\Support\Logger\RequestGenerator;

/**
 * Interface RequestUuidGenerator
 * @package App\Support\Logger\RequestGenerator
 */
interface RequestGeneratorInterface
{
    public function generate(): string;
}
