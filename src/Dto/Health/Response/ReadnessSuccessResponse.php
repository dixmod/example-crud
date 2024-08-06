<?php

namespace App\Dto\Health\Response;

use App\Traits\JsonSerializeTraitRecurse;
use JsonSerializable;
use OpenApi\Attributes as OA;

/**
 * Class ReadnessSuccessResponse
 * @package App\Dto\Health\Response;
 */
class ReadnessSuccessResponse implements JsonSerializable
{
    use JsonSerializeTraitRecurse;

    #[OA\Property(description: 'Переменные окружения')]
    private string $env;

    #[OA\Property(description: 'Статус db', enum: ['OK', 'error'], example: 'OK')]
    private string $dbStatus;

    #[OA\Property(description: 'Статус redis', enum: ['OK', 'error'], example: 'OK')]
    private string $redisStatus;

    #[OA\Property(description: 'Статус сохранения сессии в redis', enum: ['OK', 'error'], example: 'OK')]
    private string $redisSessionCheck;

    public function __construct(string $env, bool $isDbOk, bool $isRedisOk, bool $redisSessionCheck)
    {
        $this->dbStatus = $isDbOk ? 'OK' : 'error';
        $this->redisStatus = $isRedisOk ? 'OK' : 'error';
        $this->redisSessionCheck = $redisSessionCheck ? 'OK' : 'error';
        $this->env = $env;
    }
}
