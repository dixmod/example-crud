<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Interfaces\EntityResponseInterface;
use App\Traits\JsonSerializeTraitRecurse;
use JsonSerializable;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

/**
 * Class ResponseDto
 */
class ResponseDto implements JsonSerializable
{
    use JsonSerializeTraitRecurse;

    #[OA\Property(enum: [200, 400, 404,], example: [200])]
    private int $code;

    #[OA\Property(
        description: '',
        type: 'array',
        items: new OA\Items(
            ref: new Model(
                type: EntityResponseInterface::class
            ),
        ),
    )]
    private array $data;

    #[OA\Property(enum: ['OK', null], example: null)]
    private ?string $message;

    /**
     * @param int $code
     * @param array $data
     * @param string|null $message
     */
    public function __construct(int $code, array $data, ?string $message = null)
    {
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}
