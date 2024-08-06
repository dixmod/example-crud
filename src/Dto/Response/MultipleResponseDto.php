<?php

declare(strict_types=1);

namespace App\Dto\Response;

use App\Response\ApiResponse;
use JsonSerializable;

/**
 * Class MultipleResponseDto
 */
class MultipleResponseDto implements JsonSerializable
{
    /**
     * @var ApiResponse[]
     */
    private $responses;

    public function __construct(ApiResponse ...$responses)
    {
        $this->responses = $responses;
    }

    public function addResponse(ApiResponse $response): self
    {
        $this->responses[] = $response;

        return $this;
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function jsonSerialize(): array
    {
        return array_map(
            static function (ApiResponse $response): array {
                return (new ResponseDto(
                    $response->getCode(),
                    $response->getData(),
                    $response->getMessage(),
                ))->jsonSerialize();
            },
            $this->responses
        );
    }
}
