<?php

namespace App\Dto\Health\Response;

use App\Traits\JsonSerializeTraitRecurse;
use JsonSerializable;
use OpenApi\Attributes as OA;

/**
 * Class LivenessSuccessResponse
 * @package App\Dto\Health\Response;
 */
class LivenessSuccessResponse implements JsonSerializable
{
    use JsonSerializeTraitRecurse;

    #[OA\Property(description: 'Статус', enum: [true, false], example: true)]
    private bool $status;

    /**
     * @param bool $status
     */
    public function __construct(bool $status)
    {
        $this->status = $status;
    }
}
