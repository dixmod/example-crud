<?php

namespace App\Dto\Response;

use App\Traits\JsonSerializeTraitRecurse;
use JsonSerializable;
use OpenApi\Attributes as OA;

/**
 * Class SuccessCreateDto
 * @package App\Dto\Response
 */
class SuccessCreateDto implements JsonSerializable
{
    use JsonSerializeTraitRecurse;

    #[OA\Property(description: 'Идентификатор созданной сущности', example: 100500)]
    private int $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
