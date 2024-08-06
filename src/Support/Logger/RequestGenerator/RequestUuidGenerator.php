<?php

namespace App\Support\Logger\RequestGenerator;

use Symfony\Component\Uid\Uuid;

/**
 * Class RequestUuidGenerator
 * @package App\Support\Logger\RequestGenerator
 */
class RequestUuidGenerator implements RequestGeneratorInterface
{
    public function generate(): string
    {
        return Uuid::v4()->toRfc4122();
    }
}
